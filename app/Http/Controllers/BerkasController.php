<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'berkas' => Berkas::all(),
        ];

        return view('pages.admin.berkas.index', $data);
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
            'create_nama_berkas' => ['required', Rule::unique('berkas', 'nama_berkas')],
            'create_status' => ['required']
        ]);

        Berkas::create([
            'nama_berkas' => $validated['create_nama_berkas'],
            'status' => $validated['create_status'],
        ]);

        Alert::success('Success', 'Berkas Berhasil Ditambahkan');

        return redirect()->route('admin.berkas.index');
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
        $berkas = Berkas::findOrFail($id);

        $validated = $request->validate([
            'update_nama_berkas' => ['required', 'string', Rule::unique('berkas', 'nama_berkas')->ignore($berkas->id, 'id')],
            'update_status' => ['required', 'string']
        ]);

        Berkas::where('id', $id)->update([
            'nama_berkas' => $validated['update_nama_berkas'],
            'status' => $validated['update_status'],
        ]);

        Alert::success('Success', 'Berkas Berhasil Diupdate');

        return redirect()->route('admin.berkas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $berkas = Berkas::findOrFail($id);
        $berkas->delete();
        Alert::success('Success', 'Berkas Berhasil Dihapus');

        return redirect()->route('admin.berkas.index');
    }
}
