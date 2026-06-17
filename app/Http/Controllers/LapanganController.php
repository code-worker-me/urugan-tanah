<?php

namespace App\Http\Controllers;

use App\Models\Urugan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LapanganController extends Controller
{
    public function create(Urugan $urugan)
    {
        return view("lapangan.create", compact("urugan"));
    }

    public function addLapangan(Request $request, Urugan $urugan)
    {

        $request->validate([
            'admin_lapangan_id' => 'required|exists:users,id'
        ]);
        $urugan->update([
            "admin_lapangan_id" => $request->admin_lapangan_id,
        ]);
        return redirect()
            ->route("urugan.view", $urugan)
            ->with("success", "Admin lapangan berhasil dibuat.");
    }
}
