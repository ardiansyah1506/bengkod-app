<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'dokter','detailPeriksa'])->get();
        return view('dokter.periksa.index', compact('periksas'));
    }

    public function create()
    {
        $users = User::all();
        $obat =Obat::all();
    //    dd($obat);
        return view('dokter.periksa.create', compact('users','obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'id_dokter' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'id_obat' => 'nullable|integer',
        ]);

        $periksa = Periksa::create($request->all());
        DetailPeriksa::create([
            'id_periksa' => $periksa->id,
            'id_obat' => $request->id_obat
        ]);
        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil ditambahkan.');
    }

   

    public function edit(Periksa $periksa)
    {
        $users = User::all();
        $obat =Obat::all();
        return view('dokter.periksa.edit', compact('periksa', 'users','obat'));
    }

    public function update(Request $request, Periksa $periksa)
    {
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'id_dokter' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|integer',
        ]);

        $periksa->update($request->all());

        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil diperbarui.');
    }

    public function destroy(Periksa $periksa)
    {
        $periksa->delete();

        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil dihapus.');
    }
}
