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

    public function store(Request $request, Urugan $urugan)
    {
        $validated = $request->validate([
            "name" => ["required"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed"],
        ]);

        $lapangan = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "role" => "lapangan",
        ]);

        $urugan->update([
            "admin_lapangan_id" => $lapangan->id,
        ]);

        return redirect()
            ->route("urugan.view", $urugan)
            ->with("success", "Admin lapangan berhasil dibuat.");
    }
}
