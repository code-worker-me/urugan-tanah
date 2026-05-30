<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRitaseRequest;
use App\Models\Ritase;
use Illuminate\Http\Request;
use App\Models\Urugan;
use App\Services\RitaseService;

class RitaseController extends Controller
{
    public function index(Urugan $urugan)
    {
        $ritase = $urugan->ritase()->latest("tanggal")->paginate(10);
        return view("ritase-tanah.index", compact("ritase", "urugan"));
    }

    public function create(Urugan $urugan)
    {
        return view("ritase-tanah.create", compact("urugan"));
    }

    public function store(
        StoreRitaseRequest $request,
        Urugan $urugan,
        RitaseService $ritaseService,
    ) {
        $ritaseService->create(
            $urugan,
            $request->validated(),
            $request->file("foto"),
        );

        return redirect()
            ->route("ritase.index", $urugan)
            ->with("success", "Data ritase tanah berhasil ditambah");
    }

    public function delete(
        Urugan $urugan,
        Ritase $ritase,
        RitaseService $ritaseService,
    ) {
        $ritaseService->delete($urugan, $ritase);
        return back()->with("success", "Data ritase berhasil dihapus!");
    }
}
