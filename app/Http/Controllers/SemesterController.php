<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'semesters' => Semester::orderBy('kode_semester', 'asc')->get(),
        ];

        return view('pages.admin.semester.index', $data);
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
            'create_nama_semester' => ['required', 'string', Rule::unique('semesters', 'nama_semester')],
            'create_kode_semester' => ['required', 'string', 'size:5'],
            'create_semester' => ['required', 'string'],
            'create_tahun_ajaran' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
        ]);

        $semester = new Semester();
        $semester->nama_semester = $validated['create_nama_semester'];
        $semester->kode_semester = $validated['create_kode_semester'];
        $semester->semester = $validated['create_semester'];
        $semester->tahun_ajaran = $validated['create_tahun_ajaran'];
        $semester->save();

        Alert::success('Success', 'Semester Berhasil Ditambahkan');

        return redirect()->route('admin.semester.index');
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
        $semester = Semester::findOrFail($id);

        $validated = $request->validate([
            'update_nama_semester' => ['required', 'string', Rule::unique('semesters', 'nama_semester')->ignore($semester->id, 'id')],
            'update_kode_semester' => ['required', 'string', 'size:5'],
            'update_semester' => ['required', 'string'],
            'update_tahun_ajaran' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
        ]);

        Semester::where('id', $id)->update([
            'nama_semester' => $validated['update_nama_semester'],
            'kode_semester' => $validated['update_kode_semester'],
            'semester' => $validated['update_semester'],
            'tahun_ajaran' => $validated['update_tahun_ajaran'],
        ]);

        Alert::success('Success', 'Semester Berhasil Diupdate');

        return redirect()->route('admin.semester.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
