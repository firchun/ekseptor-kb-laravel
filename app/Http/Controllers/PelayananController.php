<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PelayananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pelayanan Keluraga Berencana',
        ];
        return view('pelayanan.index', $data);
    }
    public function getPelayananDataTable()
    {
        $pelayanan = Pelayanan::orderByDesc('id');
        if (Auth::user()->role != 'Admin') {
            $pelayanan->where('id_puskesmas', Auth::user()->id_puskesmas);
        }
        return DataTables::of($pelayanan)
            ->addColumn('action', function ($pelayanan) {
                return view('pelayanan.components.actions', compact('pelayanan'));
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_puskesmas' => 'required|exists:puskesmas,id',
            'id_kelurahan' => 'required|exists:kelurahan,id',
            'kb_aktif' => 'required|string|max:255',
            'komplikasi' => 'required|string|max:255',
            'kegagalan' => 'required|string|max:255',
            'dropout' => 'required|string|max:255',
            'pus_miskin' => 'required|string|max:255',
            'pus_4t' => 'required|string|max:255',
        ]);

        $pelayananData = [
            'id_puskesmas' => $request->input('id_puskesmas'),
            'id_kelurahan' => $request->input('id_kelurahan'),
            'kb_aktif' => $request->input('kb_aktif'),
            'komplikasi' => $request->input('komplikasi'),
            'kegagalan' => $request->input('kegagalan'),
            'dropout' => $request->input('dropout'),
            'pus_miskin' => $request->input('pus_miskin'),
            'pus_4t' => $request->input('pus_4t'),
        ];

        if ($request->filled('id')) {
            $pelayanan = Pelayanan::find($request->input('id'));
            if (!$pelayanan) {
                return response()->json(['message' => 'pelayanan not found'], 404);
            }

            $pelayanan->update($pelayananData);
            $message = 'pelayanan updated successfully';
        } else {
            Pelayanan::create($pelayananData);
            $message = 'pelayanan created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $pelayanan = Pelayanan::find($id);

        if (!$pelayanan) {
            return response()->json(['message' => 'pelayanan not found'], 404);
        }

        $pelayanan->delete();

        return response()->json(['message' => 'pelayanan deleted successfully']);
    }
    public function edit($id)
    {
        $pelayanan = Pelayanan::find($id);

        if (!$pelayanan) {
            return response()->json(['message' => 'pelayanan not found'], 404);
        }

        return response()->json($pelayanan);
    }
}