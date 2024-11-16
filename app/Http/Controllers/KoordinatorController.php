<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'koordinators' => Koordinator::all()
        ];

        return view('pages.admin.koordinator.index', $data);
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
            'create_nama' => ['required', 'string'],
            'create_email' => ['required', 'string', 'email'],
            'create_nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        // create data user
        $userKoordinator = new User();
        $userKoordinator->name = $validated['create_nama'];
        $userKoordinator->username = $validated['create_email'];
        $userKoordinator->email = $validated['create_email'];
        $userKoordinator->password = Hash::make(12345678);
        $userKoordinator->role = 'koordinator';
        $userKoordinator->save();

        $prodi = new Koordinator();
        $prodi->nama = $validated['create_nama'];
        $prodi->email = $validated['create_email'];
        $prodi->nomor_telp = $validated['create_nomor_telp'];
        $prodi->id_user = $userKoordinator->id;
        $prodi->save();

        Alert::success('Success', 'Koordinator Berhasil Ditambahkan');

        return redirect()->route('admin.koordinator.index');
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
        $koordinator = Koordinator::findOrFail($id);

        $validated = $request->validate([
            'update_nama' => ['required', 'string'],
            'update_email' => ['required', 'string', 'email'],
            'update_nomor_telp' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        // Cek apakah ada perubahan pada nama atau email
        $isNamaBerubah = $koordinator->nama !== $validated['update_nama'];
        $isEmailBerubah = $koordinator->email !== $validated['update_email'];

        // Update data user jika ada perubahan pada nama_dosen atau email
        if ($isNamaBerubah || $isEmailBerubah) {
            $user = User::find($koordinator->id_user);

            if ($user) {
                $user->update([
                    'name' => $validated['update_nama'],
                    'email' => $validated['update_email'],
                    'username' => $validated['update_email'],
                ]);
            }
        }

        Koordinator::where('id', $id)->update([
            'nama' => $validated['update_nama'],
            'email' => $validated['update_email'],
            'nomor_telp' => $validated['update_nomor_telp'],
        ]);

        Alert::success('Success', 'Koordinator Berhasil Diupdate');

        return redirect()->route('admin.koordinator.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $koordinator = Koordinator::findOrFail($id);
        $user = User::find($koordinator->id_user);
        $koordinator->delete();
        $user->delete();

        Alert::success('Success', 'Koordinator Berhasil Dihapus');

        return redirect()->route('admin.koordinator.index');
    }
}
