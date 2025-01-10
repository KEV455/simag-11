<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenilaian;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'kriteria_penilaians' => KriteriaPenilaian::all(),
        ];

        return view('pages.koordinator.kriteria-penilaian.index', $data);
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
            'create_nama_kriteria_penilaian' => ['required', Rule::unique('kriteria_penilaians', 'nama_kriteria_penilaian')],
            'create_status' => ['required']
        ]);

        $statusValue = false;
        if ($validated['create_status'] === "true") {
            $statusValue = true;
        }

        KriteriaPenilaian::create([
            'nama_kriteria_penilaian' => $validated['create_nama_kriteria_penilaian'],
            'status' => $statusValue,
        ]);

        Alert::success('Success', 'Kriteria Penilaian Berhasil Ditambahkan');

        return redirect()->route('koordinator.kriteria.penilaian.index');
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
        $kriteria_penilaian = KriteriaPenilaian::findOrFail($id);

        $validated = $request->validate([
            'update_nama_kriteria_penilaian' => ['required', 'string', Rule::unique('kriteria_penilaians', 'nama_kriteria_penilaian')->ignore($kriteria_penilaian->id, 'id')],
            'update_status' => ['required']
        ]);

        $statusValue = false;
        if ($validated['update_status'] === "true") {
            $statusValue = true;
        }

        KriteriaPenilaian::where('id', $id)->update([
            'nama_kriteria_penilaian' => $validated['update_nama_kriteria_penilaian'],
            'status' => $statusValue,
        ]);

        Alert::success('Success', 'Kriteria Penilaian Berhasil Diupdate');

        return redirect()->route('koordinator.kriteria.penilaian.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriteria_penilaian = KriteriaPenilaian::findOrFail($id);
        $kriteria_penilaian->delete();

        Alert::success('Success', 'Kriteria Penilaian Berhasil Dihapus');

        return redirect()->route('koordinator.kriteria.penilaian.index');
    }
}
