<?php

namespace App\Services;

use App\Models\Urugan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UruganService
{
    public function create(array $data, ?UploadedFile $file = null): Urugan
    {
        if ($file) {
            $path = $file->store("uploads/urugan", "public");
            $data["fileupload"] = $path;
        }

        return Urugan::create($data);
    }

    public function updateStatus(Urugan $urugan, string $status): Urugan
    {
        $urugan->update([
            "status" => $status,
        ]);

        return $urugan;
    }

    public function delete(Urugan $urugan): bool
    {
        $ritasesWithFoto = $urugan->ritase()->whereNotNull("foto")->get();

        foreach ($ritasesWithFoto as $ritase) {
            if (Storage::disk("public")->exists($ritase->foto)) {
                Storage::disk("public")->delete($ritase->foto);
            }
        }

        if (
            $urugan->fileupload &&
            Storage::disk("public")->exists($urugan->fileupload)
        ) {
            Storage::disk("public")->delete($urugan->fileupload);
        }

        return $urugan->delete();
    }

    public function update(
        Urugan $urugan,
        array $data,
        ?UploadedFile $file = null,
    ): Urugan {
        if ($file) {
            if (
                $urugan->fileupload &&
                Storage::disk("public")->exists($urugan->fileupload)
            ) {
                Storage::disk("public")->delete($urugan->fileupload);
            }

            $path = $file->store("uploads/urugan", "public");
            $data["fileupload"] = $path;
        }

        $urugan->update($data);

        return $urugan;
    }
}
