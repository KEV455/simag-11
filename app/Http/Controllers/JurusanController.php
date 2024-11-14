<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'jurusans' => Jurusan::all(),
        ];

        return view('pages.admin.jurusan.index', $data);
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
            'create_nama_jurusan' => ['required', 'string', Rule::unique('jurusans', 'nama_jurusan')],
        ]);

        $jurusan = new Jurusan();
        $jurusan->nama_jurusan = $validated['create_nama_jurusan'];
        $jurusan->save();

        Alert::success('Success', 'Jurusan Berhasil Ditambahkan');

        return redirect()->route('admin.jurusan.index');
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
        $jurusan = Jurusan::findOrFail($id);

        $validated = $request->validate([
            'update_nama_jurusan' => ['required', 'string', Rule::unique('jurusans', 'nama_jurusan')->ignore($jurusan->id, 'id')],
        ]);

        Jurusan::where('id', $id)->update([
            'nama_jurusan' => $validated['update_nama_jurusan'],
        ]);

        Alert::success('Success', 'Jurusan Berhasil Diupdate');

        return redirect()->route('admin.jurusan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        Alert::success('Success', 'Jurusan Berhasil Dihapus');

        return redirect()->route('admin.jurusan.index');
    }
}
