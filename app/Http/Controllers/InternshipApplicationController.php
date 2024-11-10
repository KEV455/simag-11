<?php

namespace App\Http\Controllers;

use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipApplicationController extends Controller
{
    public function index()
    {
        $applications = InternshipApplication::where('user_id', Auth::id())->get();
        return view('internship.index', compact('applications'));
    }

    public function create()
    {
        return view('internship.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        InternshipApplication::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'position' => $request->position,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        return redirect()->route('internship.index')->with('success', 'Pengajuan magang berhasil disimpan.');
    }
}
