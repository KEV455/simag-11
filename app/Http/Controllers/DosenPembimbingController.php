<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class DosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'dosen' => Dosen::all(),
            'dosen_pembimbing' => DosenPembimbing::all()
        ];

        return view('pages.kaprodi.dosenpembimbing.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dosen' => ['required'],
            'status' => ['required']
        ]);

        DosenPembimbing::create([
            'id_dosen' => $validated['dosen'],
            'status' => $validated['status'],
        ]);


        // Temukan dosen yang terkait
        $dosen = Dosen::findOrFail($validated['dosen']);

        // Perbarui role pengguna menjadi 'dospem'
        if ($dosen->user) {
            $dosen->user->update(['role' => 'dospem']);
        }

        Alert::success('Success', 'Dosen Pembimbing Berhasil Ditambahkan');

        return redirect()->route('kaprodi.dospem.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dospem = DosenPembimbing::findOrFail($id);

        $validated = $request->validate([
            'dosen' => ['required', 'string', Rule::unique('dosen_pembimbings', 'id_dosen')->ignore($dospem->id, 'id')],
            'status' => ['required', 'string']
        ]);

        DosenPembimbing::where('id', $id)->update([
            'id_dosen' => $validated['dosen'],
            'status' => $validated['status'],
        ]);

        Alert::success('Success', 'Dosen Pembimbing Berhasil Diupdate');

        return redirect()->route('kaprodi.dospem.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dospem = DosenPembimbing::findOrFail($id);

        $user = $dospem->dosen->user;

        if ($user) {
            $user->update(['role' => 'dosen']);
        }
        $dospem->delete();

        Alert::success('Success', 'Dosen Pembimbing Berhasil Dihapus');

        return redirect()->route('kaprodi.dospem.index');
    }
}
