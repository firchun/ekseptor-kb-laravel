<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KelurahanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kelurahan',
        ];
        return view('kelurahan.index', $data);
    }
    public function getKelurahanDataTable()
    {
        $kelurahan = Kelurahan::orderByDesc('id');
        if (Auth::user()->role != 'Admin') {
            $kelurahan->where('id_puskesmas', Auth::user()->id_puskesmas);
        }

        return DataTables::of($kelurahan)
            ->addColumn('action', function ($kelurahan) {
                return view('kelurahan.components.actions', compact('kelurahan'));
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelurahan' => 'required|string|max:255',
            'id_puskesmas' => 'required|exists:puskesmas,id',
        ]);

        $kelurahanData = [
            'nama_kelurahan' => $request->input('nama_kelurahan'),
            'id_puskesmas' => $request->input('id_puskesmas'),
        ];

        if ($request->filled('id')) {
            $kelurahan = Kelurahan::find($request->input('id'));
            if (!$kelurahan) {
                return response()->json(['message' => 'kelurahan not found'], 404);
            }

            $kelurahan->update($kelurahanData);
            $message = 'kelurahan updated successfully';
        } else {
            kelurahan::create($kelurahanData);
            $message = 'kelurahan created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $kelurahan = kelurahan::find($id);

        if (!$kelurahan) {
            return response()->json(['message' => 'kelurahan not found'], 404);
        }

        $kelurahan->delete();

        return response()->json(['message' => 'kelurahan deleted successfully']);
    }
    public function edit($id)
    {
        $kelurahan = kelurahan::find($id);

        if (!$kelurahan) {
            return response()->json(['message' => 'kelurahan not found'], 404);
        }

        return response()->json($kelurahan);
    }
}