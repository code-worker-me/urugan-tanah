<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJadwalRequest;
use App\Models\JadwalTruk;
use App\Models\Urugan;
use App\Services\JadwalService;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $data = JadwalTruk::with(["urugan"])
            ->kerja()
            ->latest("waktu")
            ->paginate(15);
        return view("jadwal", compact("data"));
    }

    public function indexUrugan(Urugan $urugan)
    {
        $jadwal = $urugan->jadwal()->latest("waktu")->paginate(10);
        return view("jadwal-truk.index", compact("urugan", "jadwal"));
    }

    public function create(Urugan $urugan)
    {
        return view("jadwal-truk.create", compact("urugan"));
    }

    public function store(
        StoreJadwalRequest $request,
        Urugan $urugan,
        JadwalService $jadwalService,
    ) {
        $jadwalService->create($urugan, $request->validated());

        return redirect()
            ->route("jadwalUrugan.index", $urugan)
            ->with("success", "Jadwal berhasil ditambahkan!");
    }

    public function delete(
        Urugan $urugan,
        JadwalTruk $jadwal,
        JadwalService $jadwalService,
    ) {
        $jadwalService->delete($urugan, $jadwal);
        return back()->with("success", "Jadwal berhasil dihapus!");
    }
}
