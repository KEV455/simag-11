<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = [
            'tahun_ajaran_aktif' => TahunAjaran::where('status', true)->first(),
            'semesters' => Semester::orderBy('kode_semester', 'asc')->get(),
        ];

        return view('pages.admin.tahun-ajaran.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_semester' => ['required'],
        ]);

        TahunAjaran::where('id', $id)->update([
            'id_semester' => $validated['id_semester'],
        ]);

        Alert::success('Success', 'Tahun Ajaran Aktif Berhasil Diupdate');

        return redirect()->route('admin.tahun.ajaran.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
