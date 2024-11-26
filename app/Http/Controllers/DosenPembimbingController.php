<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Kaprodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class DosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua id_prodi yang sudah terdaftar di tabel DosenPembimbing
        $dosenPembimbingId = DosenPembimbing::pluck('id_dosen')->toArray();

        // Mengambil data Kaprodi berdasarkan id_user yang sedang login
        $kaprodi = Kaprodi::where('id_user', Auth::user()->id)->first();

        // Jika data Kaprodi tidak ditemukan
        if (!$kaprodi) {
            return redirect()->back()->with('error', 'Data Kaprodi tidak ditemukan');
        }

        $dosenByProdi = Dosen::where('id_prodi', $kaprodi->id_prodi)->whereNotIn('id', $dosenPembimbingId)->get();

        // Mengambil data Dosen berdasarkan id_prodi Kaprodi
        $dosenIds = Dosen::where('id_prodi', $kaprodi->id_prodi)->pluck('id');

        // Mengambil data Dosen Pembimbing berdasarkan id_dosen yang sesuai
        $dospem_by_prodi = DosenPembimbing::whereIn('id_dosen', $dosenIds)->get();

        $data = [
            'dosen' => $dosenByProdi,
            'dosen_pembimbing' => $dospem_by_prodi,
        ];

        return view('pages.kaprodi.dosenpembimbing.index', $data);
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
            'create_id_dosen' => ['required'],
            'create_status' => ['required']
        ]);

        DosenPembimbing::create([
            'id_dosen' => $validated['create_id_dosen'],
            'status' => $validated['create_status'],
        ]);

        // Temukan dosen yang terkait
        $dosen = Dosen::findOrFail($validated['create_id_dosen']);

        // Perbarui role pengguna menjadi 'dospem'
        if ($dosen->user) {
            $dosen->user->update(['role' => 'dospem']);
        }

        Alert::success('Success', 'Dosen Pembimbing Berhasil Ditambahkan');

        return redirect()->route('kaprodi.dospem.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
        $dospem = DosenPembimbing::findOrFail($id);

        // dd($request);

        $validated = $request->validate([
            'update_id_dosen' => ['nullable', 'string', Rule::unique('dosen_pembimbings', 'id_dosen')->ignore($dospem->id, 'id')],
            'update_status' => ['required', 'string']
        ]);

        // melakukan cek jika request id_dosen
        if ($validated['update_id_dosen'] == null) {
            $validated['update_id_dosen'] = $dospem->id_dosen;
        }

        // Cek apakah ada perubahan pada id_dosen
        $isIdDosenBerubah = $dospem->id_dosen !== $validated['update_id_dosen'];

        // Update data user jika ada perubahan pada id_dosen
        if ($isIdDosenBerubah) {
            // user dospem lama di ubah menjadi role dosen
            $dosen = Dosen::find($dospem->id_dosen);
            $userDosen = User::find($dosen->id_user);

            $dosenDospemBaru = Dosen::find($validated['update_id_dosen']);
            $userDospemBaru = User::find($dosenDospemBaru->id_user);

            if ($userDosen) {
                $userDosen->update([
                    'role' => 'dosen',
                ]);
            }

            // menjadikan user baru sebagai role dospem
            if ($userDospemBaru) {
                $userDospemBaru->update([
                    'role' => 'dospem',
                ]);
            }
        }

        DosenPembimbing::where('id', $id)->update([
            'id_dosen' => $validated['update_id_dosen'] ?? $dospem->id_dosen,
            'status' => $validated['update_status'],
        ]);

        Alert::success('Success', 'Dosen Pembimbing Berhasil Diupdate');

        return redirect()->route('kaprodi.dospem.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dospem = DosenPembimbing::findOrFail($id);

        $user = $dospem->dosen->user;

        if ($user) {
            $user->update(['role' => 'dosen']);
        }

        $dospem->delete();

        Alert::success('Success', 'Dosen Pembimbing Berhasil Dihapus');

        return redirect()->route('kaprodi.dospem.index');
    }
}
