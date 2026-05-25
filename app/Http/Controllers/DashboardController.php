<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urugan;
use App\Http\Requests\StoreUruganRequest;
use App\Http\Requests\UpdateStatusUruganRequest;
use App\Services\UruganService;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Urugan::latest()->paginate(10);
        return view("dashboard", compact("projects"));
    }

    public function createUrugan()
    {
        return view("urugan.create");
    }

    public function editUrugan(Urugan $urugan)
    {
        return view("urugan.edit", compact("urugan"));
    }

    public function showUrugan(Urugan $urugan)
    {
        return view("urugan.view", compact("urugan"));
    }

    public function storeUrugan(
        StoreUruganRequest $request,
        UruganService $uruganService,
    ) {
        $validated = $request->validated();
        $urugan = $uruganService->create(
            $request->validated(),
            $request->file("fileupload"),
        );
        return redirect()
            ->route("dashboard")
            ->with("success", "Pengajuan Urugan telah dibuat!!");
    }

    public function updateStatus(
        UpdateStatusUruganRequest $request,
        Urugan $urugan,
        UruganService $uruganService,
    ) {
        $validated = $request->validated();
        $uruganService->updateStatus($urugan, $validated["status"]);
        return redirect()
            ->back()
            ->with(
                "success",
                "Status pengajuan berhasil diperbarui menjadi: " .
                    ucfirst($validated["status"]),
            );
    }

    public function deleteUrugan(Urugan $urugan, UruganService $uruganService)
    {
        $uruganService->delete($urugan);
        return redirect()
            ->route("dashboard")
            ->with("success", "Data Urugan Berhasil dihapus!!");
    }

    public function updateUrugan(
        StoreUruganRequest $request,
        Urugan $urugan,
        UruganService $uruganService,
    ) {
        $uruganService->update(
            $urugan,
            $request->validated(),
            $request->file("fileupload"),
        );
        return redirect()
            ->route("dashboard")
            ->with("success", "Data pengajuan urugan berhasil diperbarui!");
    }
}
