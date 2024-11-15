<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'prodis' => Prodi::all(),
            'jurusans' => Jurusan::all()
        ];

        return view('pages.admin.prodi.index', $data);
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
            'create_nama_program_studi' => ['required', 'string', Rule::unique('prodis', 'nama_program_studi')],
            'create_jenjang_pendidikan' => ['required', 'string'],
            'create_kode_prodi' => ['required', 'string', 'size:5', 'alpha_num'],
            'create_id_jurusan' => ['required', 'string'],
        ]);

        $prodi = new Prodi;
        $prodi->nama_program_studi = $validated['create_nama_program_studi'];
        $prodi->jenjang_pendidikan = $validated['create_jenjang_pendidikan'];
        $prodi->kode_prodi = $validated['create_kode_prodi'];
        $prodi->id_jurusan = $validated['create_id_jurusan'];
        $prodi->save();

        Alert::success('Success', 'Prodi Berhasil Ditambahkan');

        return redirect()->route('admin.prodi.index');
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
        $prodi = Prodi::findOrFail($id);

        $validated = $request->validate([
            'update_nama_program_studi' => ['required', 'string', Rule::unique('prodis', 'nama_program_studi')->ignore($prodi->id, 'id')],
            'update_jenjang_pendidikan' => ['required', 'string'],
            'update_kode_prodi' => ['required', 'string', 'size:5', 'alpha_num'],
            'update_id_jurusan' => ['required', 'string'],
        ]);

        Prodi::where('id', $id)->update([
            'nama_program_studi' => $validated['update_nama_program_studi'],
            'jenjang_pendidikan' => $validated['update_jenjang_pendidikan'],
            'kode_prodi' => $validated['update_kode_prodi'],
            'id_jurusan' => $validated['update_id_jurusan'],
        ]);

        Alert::success('Success', 'Prodi Berhasil Diupdate');

        return redirect()->route('admin.prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        Alert::success('Success', 'Prodi Berhasil Dihapus');

        return redirect()->route('admin.prodi.index');
    }
}
