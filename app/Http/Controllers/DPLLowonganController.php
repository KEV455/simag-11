<?php

namespace App\Http\Controllers;

use App\Models\DPLLowongan;
use App\Models\DPLMitra;
use App\Models\Lowongan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DPLLowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();

        $data = [
            'dpl_lowongans' => DPLLowongan::where('id_dpl_mitra', $id)
                ->whereHas('lowongan', function ($query) use ($tahun_ajaran_aktif) {
                    $query->where('id_semester', $tahun_ajaran_aktif->id_semester);
                })
                ->get(),
            'dpl_mitra' => DPLMitra::findOrFail($id),
        ];

        return view('pages.koordinator.dpl-lowongan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $tahun_ajaran_aktif = TahunAjaran::where('status', true)->first();
        $dpl_mitra = DPLMitra::findOrFail($id);

        $lowonganTersedia = Lowongan::where('id_semester', $tahun_ajaran_aktif->id_semester)->where('id_mitra', $dpl_mitra->id_mitra)->where('status', 'Aktif')->whereNotIn('id', function ($query) use ($id) {
            $query->select('id_lowongan')
                ->from('dpl_lowongans')
                ->where('id_dpl_mitra', $id);
        })->get();

        $data = [
            'dpl_mitra' => $dpl_mitra,
            'lowongans' => $lowonganTersedia
        ];

        return view('pages.koordinator.dpl-lowongan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'lowongans' => ['required', 'array', 'min:1'],
        ]);

        $dpl_mitra = DPLMitra::findOrFail($id);
        $lowongan_convert = collect($validated['lowongans']);
        $check_id_lowongan = $lowongan_convert->except('_token');

        if ($check_id_lowongan) {
            foreach ($check_id_lowongan as $lowonganId) {
                DPLLowongan::create([
                    'id_dpl_mitra' => $dpl_mitra->id,
                    'id_lowongan' => $lowonganId,
                ]);
            }
        }

        Alert::success('Success', 'Data Lowongan DPL Berhasil Ditambahkan');

        return redirect()->route('koordinator.dpl.lowongan.index', $id);
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
        $dpl_lowongan = DPLLowongan::findOrFail($id);
        $id_dpl_mitra = $dpl_lowongan->id_dpl_mitra;
        $dpl_lowongan->delete();

        Alert::success('Success', 'Data Lowongan DPL Berhasil Dihapus');

        return redirect()->route('koordinator.dpl.lowongan.index', $id_dpl_mitra);
    }
}
