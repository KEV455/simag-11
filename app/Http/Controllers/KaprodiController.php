<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua id_prodi yang sudah terdaftar di tabel Kaprodi
        $kaprodiProdiId = Kaprodi::pluck('id_prodi')->toArray();
        $kaprodiUserId = Kaprodi::pluck('id_user')->toArray();

        // Mengambil id_user yang sedang di-update dari request (jika ada)
        $currentUserId = $request->input('id_user');

        // Mengambil data prodi yang belum terdaftar di tabel Kaprodi
        $prodi_filter = Prodi::whereNotIn('id', $kaprodiProdiId)->get();

        // Mengambil user kaprodi yang belum terdaftar di tabel Kaprodi
        $user_filter = User::where('role', 'kaprodi')
            ->whereNotIn('id', $kaprodiUserId)
            ->orWhere('id', $currentUserId) // Tambahkan pengecekan untuk user yang sedang di-update
            ->get();

        // Mengambil semua data Kaprodi, Prodi, dan User
        $data = [
            'kaprodis' => Kaprodi::all(),
            'prodi_all' => Prodi::all(),
            'prodi_filter' => $prodi_filter,
            'user_all' => User::where('role', 'kaprodi')->get(),
            'user_kaprodi_filter' => $user_filter,
        ];

        return view('pages.admin.kaprodi.index', $data);
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
            'create_periode_mulai' => ['required', 'string', 'date'],
            'create_periode_selesai' => ['required', 'string', 'date'],
            'create_status' => ['required', 'string'],
            'create_id_prodi' => ['required', 'string'],
            'create_id_user' => ['required', 'string'],
        ]);

        $kaprodi = new Kaprodi();
        $kaprodi->periode_mulai = $validated['create_periode_mulai'];
        $kaprodi->periode_selesai = $validated['create_periode_selesai'];
        $kaprodi->status = $validated['create_status'];
        $kaprodi->id_prodi = $validated['create_id_prodi'];
        $kaprodi->id_user = $validated['create_id_user'];
        $kaprodi->save();

        Alert::success('Success', 'Kaprodi Berhasil Ditambahkan');

        return redirect()->route('admin.kaprodi.index');
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
        $kaprodi = Kaprodi::find($id);

        $validated = $request->validate([
            'update_periode_mulai' => ['required', 'string', 'date'],
            'update_periode_selesai' => ['required', 'string', 'date'],
            'update_status' => ['required', 'string',],
            // 'update_id_prodi' => ['nullable', 'string'],
            'update_id_user' => ['nullable', 'string'],
        ]);

        Kaprodi::where('id', $id)->update([
            'periode_mulai' => $validated['update_periode_mulai'],
            'periode_selesai' => $validated['update_periode_selesai'],
            'status' => $validated['update_status'],
            // 'id_prodi' => $validated['update_id_prodi'],
            'id_user' => $validated['update_id_user'] ?? $kaprodi->id_user,
        ]);

        Alert::success('Success', 'Kaprodi Berhasil Diupdate');

        return redirect()->route('admin.kaprodi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kaprodi = Kaprodi::findOrFail($id);
        $kaprodi->delete();

        Alert::success('Success', 'Kaprodi Berhasil Dihapus');

        return redirect()->route('admin.kaprodi.index');
    }
}
