<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\DosenImport;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'dosens' => Dosen::all(),
        ];

        return view('pages.admin.dosen.index', $data);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // Mengecek apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            // Simpan file yang diunggah ke folder 'import/dosen' di disk 'public'
            $uploadedFile = $request->file('file');
            $filePath = $uploadedFile->store('import/dosen', 'public');

            try {
                // Dapatkan path absolut dari file
                $absolutePath = Storage::disk('public')->path($filePath);

                // Import data dosen dari file yang diunggah
                Excel::import(new DosenImport(), $absolutePath);

                // Hapus file setelah import berhasil
                Storage::disk('public')->delete($filePath);

                // Beri notifikasi sukses
                Alert::success('Success', 'Data Dosen Berhasil Diimport');
            } catch (\Exception $e) {
                // Beri notifikasi jika terjadi kesalahan
                Alert::error('Error', 'Data Dosen Gagal Diimport: ' . $e->getMessage());

                // Hapus file jika terjadi kesalahan
                Storage::disk('public')->delete($filePath);
            }

            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }

        // Jika tidak ada file yang diunggah
        Alert::error('Error', 'Tidak ada file yang diunggah');
        return redirect()->back();
    }
}
