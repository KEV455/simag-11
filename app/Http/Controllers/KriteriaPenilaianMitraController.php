<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenilaian;
use App\Models\KriteriaPenilaianMitra;
use App\Models\Mitra;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaPenilaianMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = [
            'kriteria_penilaian_mitras' => KriteriaPenilaianMitra::where('id_mitra', $id)->get(),
            'mitra' => Mitra::findOrFail($id),
        ];

        return view('pages.koordinator.kriteria-penilaian-mitra.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Ambil ID dari kriteria penilaian yang sudah ditambahkan ke mitra
        $kriteriaPenilaianTersedia = KriteriaPenilaian::where('status', true)->whereNotIn('id', function ($query) use ($id) {
            $query->select('id_kriteria_penilaian')
                ->from('kriteria_penilaian_mitras')
                ->where('id_mitra', $id);
        })->get();

        $data = [
            'mitra' => Mitra::findOrFail($id),
            'kriteria_penilaian_mitras' => $kriteriaPenilaianTersedia
        ];

        return view('pages.koordinator.kriteria-penilaian-mitra.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'kriteria_penilaian_mitras' => ['required', 'array', 'min:1'],
        ]);

        $mitra = Mitra::findOrFail($id);
        $kriteria_penilaian_convert = collect($validated['kriteria_penilaian_mitras']);
        $check_id_kriteria_penilaian = $kriteria_penilaian_convert->except('_token');

        if ($check_id_kriteria_penilaian) {
            foreach ($check_id_kriteria_penilaian as $kriteriaPenilaianId) {
                KriteriaPenilaianMitra::create([
                    'id_mitra' => $mitra->id,
                    'id_kriteria_penilaian' => $kriteriaPenilaianId,
                ]);
            }
        }

        Alert::success('Success', 'Data Kriteria Penilaian Mitra Berhasil Ditambahkan');

        return redirect()->route('koordinator.kriteria.penilaian.mitra.index', $id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriteria_penilaian_mitra = KriteriaPenilaianMitra::findOrFail($id);
        $id_mitra = $kriteria_penilaian_mitra->id_mitra;
        $kriteria_penilaian_mitra->delete();

        Alert::success('Success', 'Data Kriteria Penilaian Mitra Berhasil Dihapus');

        return redirect()->route('koordinator.kriteria.penilaian.mitra.index', $id_mitra);
    }
}
