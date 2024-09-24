<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SasaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Sasaran',
        ];
        return view('sasaran.index', $data);
    }
    public function getSasaranDataTable()
    {
        $sasaran = Sasaran::with(['kelurahan', 'puskesmas'])->orderByDesc('id');
        if (Auth::user()->role != 'Admin') {
            $sasaran->where('id_puskesmas', Auth::user()->id_puskesmas);
        }
        return DataTables::of($sasaran)
            ->addColumn('action', function ($sasaran) {
                return view('sasaran.components.actions', compact('sasaran'));
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_puskesmas' => 'required|exists:puskesmas,id',
            'id_kelurahan' => 'required|exists:kelurahan,id',
            'pus_miskin' => 'required|string|max:255',
            'pus_4t' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
        ]);

        $sasaranData = [
            'id_puskesmas' => $request->input('id_puskesmas'),
            'id_kelurahan' => $request->input('id_kelurahan'),
            'pus_miskin' => $request->input('pus_miskin'),
            'pus_4t' => $request->input('pus_4t'),
            'jumlah' => $request->input('jumlah'),
        ];

        if ($request->filled('id')) {
            $sasaran = Sasaran::find($request->input('id'));
            if (!$sasaran) {
                return response()->json(['message' => 'sasaran not found'], 404);
            }

            $sasaran->update($sasaranData);
            $message = 'sasaran updated successfully';
        } else {
            Sasaran::create($sasaranData);
            $message = 'sasaran created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $sasaran = Sasaran::find($id);

        if (!$sasaran) {
            return response()->json(['message' => 'sasaran not found'], 404);
        }

        $sasaran->delete();

        return response()->json(['message' => 'sasaran deleted successfully']);
    }
    public function edit($id)
    {
        $sasaran = Sasaran::find($id);

        if (!$sasaran) {
            return response()->json(['message' => 'sasaran not found'], 404);
        }

        return response()->json($sasaran);
    }
}