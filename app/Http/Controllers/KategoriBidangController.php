<?php

namespace App\Http\Controllers;

use App\Models\KategoriBidang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriBidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'kategori_bidangs' => KategoriBidang::all(),
        ];

        return view('pages.koordinator.kategori-bidang.index', $data);
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
            'create_nama_kategori' => ['required', 'string', Rule::unique('kategori_bidangs', 'nama_kategori')],
        ]);

        $kategoriBidang = new KategoriBidang;
        $kategoriBidang->nama_kategori = $validated['create_nama_kategori'];
        $kategoriBidang->save();

        Alert::success('Success', 'Kategori Bidang Berhasil Ditambahkan');

        return redirect()->route('koordinator.kategori.bidang.index');
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
        $kategoriBidang = KategoriBidang::findOrFail($id);

        $validated = $request->validate([
            'update_nama_kategori' => ['required', 'string', Rule::unique('kategori_bidangs', 'nama_kategori')->ignore($kategoriBidang->id, 'id')],
        ]);

        KategoriBidang::where('id', $id)->update([
            'nama_kategori' => $validated['update_nama_kategori'],
        ]);

        Alert::success('Success', 'Kategori Bidang Berhasil Diupdate');

        return redirect()->route('koordinator.kategori.bidang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriBidang = KategoriBidang::findOrFail($id);
        $kategoriBidang->delete();

        Alert::success('Success', 'Kategori Bidang Berhasil Dihapus');

        return redirect()->route('koordinator.kategori.bidang.index');
    }
}
