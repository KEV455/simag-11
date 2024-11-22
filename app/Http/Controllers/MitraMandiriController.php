<?php

namespace App\Http\Controllers;

use App\Models\MitraMandiri;
use Illuminate\Http\Request;
use Laravolt\Indonesia\IndonesiaService;
use RealRashid\SweetAlert\Facades\Alert;

class MitraMandiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'mitra_mandiris' => MitraMandiri::all(),
        ];

        return view('pages.koordinator.mitra-mandiri.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $indonesia = new IndonesiaService();

        $data = [
            'mitra_mandiri' => MitraMandiri::find($id),
            'provinsis' => $indonesia->allProvinces(),
            'kotas' => $indonesia->allCities(),
        ];

        return view('pages.koordinator.mitra-mandiri.show', $data);
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

    public function diterima(string $id)
    {
        $mitra_mandiri = MitraMandiri::findOrFail($id);

        $updateData = [
            'status_disetujui' => 'Diterima',
        ];

        // Update data mitra
        $mitra_mandiri->update($updateData);

        Alert::success('Success', 'Mitra Mandiri Berhasil Disetujui');

        return redirect()->route('koordinator.mitra.mandiri.index');
    }

    public function ditolak(string $id)
    {
        $mitra_mandiri = MitraMandiri::findOrFail($id);

        $updateData = [
            'status_disetujui' => 'Ditolak',
        ];

        // Update data mitra
        $mitra_mandiri->update($updateData);

        Alert::success('Success', 'Mitra Mandiri Berhasil Ditolak');

        return redirect()->route('koordinator.mitra.mandiri.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mitra_mandiri = MitraMandiri::findOrFail($id);

        // Hapus catatan dari database
        $mitra_mandiri->delete();

        Alert::success('Success', 'Mitra Mandiri Berhasil Dihapus');

        return redirect()->route('koordinator.mitra.mandiri.index');
    }
}
