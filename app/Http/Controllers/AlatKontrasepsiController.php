<?php

namespace App\Http\Controllers;

use App\Models\AlatKontrasepsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AlatKontrasepsiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Alat Kontrasepsi',
        ];
        return view('alat.index', $data);
    }
    public function getAlatDataTable()
    {
        $alat = AlatKontrasepsi::orderByDesc('id');

        return DataTables::of($alat)
            ->addColumn('action', function ($alat) {
                return view('alat.components.actions', compact('alat'));
            })
            ->addColumn('foto', function ($alat) {
                return '<img src="' . Storage::url($alat->foto_alat) . '" style="width:80px; height:80px; object-fit:cover;">';
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
    }
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'kode_alat' => 'required|string|max:255',
            'foto_alat' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_alat' => 'required|string|max:255',
            'cara_pakai' => 'required|string',
            'kelebihan' => 'required|string',
            'kekurangan' => 'required|string',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto_alat')) {
            $file = $request->file('foto_alat');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/uploads', $fileName); // Store file in storage/app/public/uploads
            $validatedData['foto_alat'] = $filePath;
        }

        // Check if the record is being updated or created
        if ($request->filled('id')) {
            $alat = AlatKontrasepsi::find($request->input('id'));
            if (!$alat) {
                return response()->json(['message' => 'Record not found'], 404);
            }
            $alat->update($validatedData);
            $message = 'Record updated successfully';
        } else {
            AlatKontrasepsi::create($validatedData);
            $message = 'Record created successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function destroy($id)
    {
        $alat = AlatKontrasepsi::find($id);

        if (!$alat) {
            return response()->json(['message' => 'alat not found'], 404);
        }

        $alat->delete();

        return response()->json(['message' => 'alat deleted successfully']);
    }
    public function edit($id)
    {
        $alat = AlatKontrasepsi::find($id);

        if (!$alat) {
            return response()->json(['message' => 'alat not found'], 404);
        }

        return response()->json($alat);
    }
}
