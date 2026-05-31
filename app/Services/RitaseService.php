<?php
namespace App\Services;

use App\Models\Ritase;
use App\Models\Urugan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RitaseService
{
    public function create(
        Urugan $urugan,
        array $data,
        ?UploadedFile $foto = null,
    ): Ritase {
        $data["urugan_id"] = $urugan->id;

        if ($foto) {
            $path = $foto->store("ritase-tanah/foto", "public");
            $data["foto"] = $path;
        }

        return Ritase::create($data);
    }

    public function update(
        Urugan $urugan,
        Ritase $ritase,
        array $data,
        ?UploadedFile $foto = null,
    ) {
        $data["urugan_id"] = $urugan->id;

        if ($foto) {
            if (
                $ritase->foto &&
                Storage::disk("public")->exists($ritase->foto)
            ) {
                Storage::disk("public")->delete($ritase->foto);
            }
            $path = $foto->store("ritase-tanah/foto", "public");
            $data["foto"] = $path;
        }

        $ritase->update($data);
        return $ritase;
    }

    public function delete(Urugan $urugan, Ritase $ritase): bool
    {
        abort_if(
            $ritase->urugan_id !== $urugan->id,
            403,
            "Data ritase tidak cocok dengan data urugan!!",
        );

        if ($ritase->foto && Storage::disk("public")->exists($ritase->foto)) {
            Storage::disk("public")->delete($ritase->foto);
        }

        return $ritase->delete();
    }
}
