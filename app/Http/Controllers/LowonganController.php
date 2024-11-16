<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\BerkasLowongan;
use App\Models\Lowongan;
use App\Models\LowonganProdi;
use App\Models\Mitra;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'lowongan' => Lowongan::all(),
            'mitra' => Mitra::all(),
            'berkas' => Berkas::all(),
            'berkas_lowongan' => BerkasLowongan::all(),
            'lowongan_prodi' => LowonganProdi::all(),
            'prodi' => Prodi::all()
        ];
        return view('pages.koordinator.lowongan.index', $data);
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
            'mitra' => 'required',
            'nama_lowongan' => ['required', 'string', Rule::unique('lowongans', 'nama')],
            'jumlah_lowongan' => ['required'],
            'deskripsi' => ['required'],
            'tanggal_dibuka' => ['required'],
            'tanggal_ditutup' => ['required'],
            'tanggal_magang_dimulai' => ['required'],
            'tanggal_magang_ditutup' => ['required'],
            'status' => ['required'],
            'berkas' => ['required', 'array', 'min:1'],
            'prodi' => ['required', 'array', 'min:1'],
        ]);

        $newLowongan = Lowongan::create([
            'id_mitra' => $validated['mitra'],
            'nama' => $validated['nama_lowongan'],
            'jumlah_lowongan' => $validated['jumlah_lowongan'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_dibuka' => $validated['tanggal_dibuka'],
            'tanggal_ditutup' => $validated['tanggal_ditutup'],
            'tanggal_magang_dimulai' => $validated['tanggal_magang_dimulai'],
            'tanggal_magang_ditutup' => $validated['tanggal_magang_ditutup'],
            'status' => $validated['status'],
        ]);

        $prodi_convert = collect($validated['berkas']);

        $prodi = Prodi::all();
        $check_prodi = $prodi_convert->except(
            '_token',
            'nama_program_studi',
            'mitra',
            'nama_lowongan',
            'jumlah_lowongan',
            'deskripsi',
            'tanggal_dibuka',
            'tanggal_ditutup',
            'tanggal_magang_dimulai',
            'tanggal_magang_ditutup',
            'status',
        );


        if ($check_prodi) {
            foreach ($check_prodi as $prodiId) {
                if ($prodi->contains('id', $prodiId)) {
                    LowonganProdi::create([
                        'id_lowongan' => $newLowongan->id,
                        'id_prodi' => $prodiId,
                    ]);
                }
            }
        }
        $berkas_convert = collect($validated['berkas']);

        $berkas = Berkas::all();
        $check_berkas = $berkas_convert->except(
            '_token',
            'nama_berkas',
            'mitra',
            'nama_lowongan',
            'jumlah_lowongan',
            'deskripsi',
            'tanggal_dibuka',
            'tanggal_ditutup',
            'tanggal_magang_dimulai',
            'tanggal_magang_ditutup',
            'status',
        );


        if ($check_berkas) {
            foreach ($check_berkas as $berkasId) {
                if ($berkas->contains('id', $berkasId)) {
                    BerkasLowongan::create([
                        'id_lowongan' => $newLowongan->id,
                        'id_berkas' => $berkasId,
                    ]);
                }
            }
        }



        Alert::success('Success', 'Lowongan Berhasil Ditambahkan');

        return redirect()->route('admin.lowongan.index');
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
        $lowongan = Lowongan::findOrFail($id);


        $validated = $request->validate([
            'mitra' => ['required', 'string'],
            'nama_lowongan' => ['required', 'string', Rule::unique('lowongans', 'nama')->ignore($lowongan->id, 'id')],
            'jumlah_lowongan' => ['required'],
            'deskripsi' => ['required'],
            'tanggal_dibuka' => ['required'],
            'tanggal_ditutup' => ['required'],
            'tanggal_magang_dimulai' => ['required'],
            'tanggal_magang_ditutup' => ['required'],
            'status' => ['required'],
            'berkas' => ['required', 'array', 'min:1'],
            'prodi' => ['required', 'array', 'min:1'],
        ]);

        Lowongan::where('id', $id)->update([
            'id_mitra' => $validated['mitra'],
            'nama' => $validated['nama_lowongan'],
            'jumlah_lowongan' => $validated['jumlah_lowongan'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_dibuka' => $validated['tanggal_dibuka'],
            'tanggal_ditutup' => $validated['tanggal_ditutup'],
            'tanggal_magang_dimulai' => $validated['tanggal_magang_dimulai'],
            'tanggal_magang_ditutup' => $validated['tanggal_magang_ditutup'],
            'status' => $validated['status'],
        ]);

        //lowonganProdi
        $prodi_convert = collect($validated['prodi']);
        $lowonganProdi = lowonganProdi::where('id_lowongan', $id)->get();

        foreach ($prodi_convert as $prodiId) {
            if (!$lowonganProdi->contains(function ($item) use ($prodiId) {
                return $item->id_prodi == $prodiId;
            })) {
                lowonganProdi::create([
                    'id_prodi' => $prodiId,
                    'id_lowongan' => $id,
                ]);
            }
        }

        $lowonganProdi->each(function ($item) use ($prodi_convert) {
            if (!$prodi_convert->contains($item->id_prodi)) {
                $item->delete();
            }
        });

        //berkas lowongan
        $berkas_convert = collect($validated['berkas']);

        $berkasLowongan = BerkasLowongan::where('id_lowongan', $id)->get();

        foreach ($berkas_convert as $berkasId) {
            if (!$berkasLowongan->contains(function ($item) use ($berkasId) {
                return $item->id_berkas == $berkasId;
            })) {
                BerkasLowongan::create([
                    'id_berkas' => $berkasId,
                    'id_lowongan' => $id,
                ]);
            }
        }

        $berkasLowongan->each(function ($item) use ($berkas_convert) {
            if (!$berkas_convert->contains($item->id_berkas)) {
                $item->delete();
            }
        });



        Alert::success('Success', 'Lowongan Berhasil Diupdate');

        return redirect()->route('admin.lowongan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();
        Alert::success('Success', 'Lowongan Berhasil Dihapus');

        return redirect()->route('admin.lowongan.index');
    }
}
