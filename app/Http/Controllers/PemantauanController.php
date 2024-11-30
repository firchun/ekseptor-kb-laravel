<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Pemantauan;
use App\Models\PenerimaanAlat;
use App\Models\PenggunaanAlat;
use App\Models\Puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PemantauanController extends Controller
{
    public function index()
    {
        $kelurahan = Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->first();
        $data = [
            'title' => 'Data Penerimaan Alat Kontrasepsi',
            'kelurahan' => $kelurahan
        ];
        return view('pemantauan.index', $data);
    }
    public function getPemantauanDataTable()
    {
        $pemantauan = Pemantauan::with(['kelurahan']);

        if (Auth::user()->role != 'Admin') {
            $pemantauan->where('id_puskesmas', Auth::user()->id_puskesmas);
        }
        return DataTables::of($pemantauan)
            ->addColumn('action', function ($pemantauan) {
                return view('pemantauan.components.actions', compact('pemantauan'));
            })
            // ->addColumn('tanggal', function ($pemantauan) {
            //     return $pemantauan->tanggal ? $pemantauan->tanggal->format('d-m-Y') : 'Tidak diisi';
            // })
            ->addColumn('tanggal', function ($pemantauan) {
                return $pemantauan->tanggal 
                    ? \Carbon\Carbon::parse($pemantauan->tanggal)->format('d-m-Y') 
                    : 'Tidak diisi';
            })

            ->rawColumns(['action', 'tanggal'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_kelurahan' => 'required|exists:kelurahan,id',
            'id_puskesmas' => 'required|exists:puskesmas,id',
            'terima_pil' => 'required|integer|min:0',
            'terima_suntik' => 'required|integer|min:0',
            'terima_akdr' => 'required|integer|min:0',
            'terima_impln' => 'required|integer|min:0',
            'terima_kdm' => 'required|integer|min:0',
            'tanggal' => 'required',
        ]);

        $pemantauanData = [
            'id_kelurahan' => $request->input('id_kelurahan'),
            'id_puskesmas' => $request->input('id_puskesmas'),
            'terima_pil' => $request->input('terima_pil'),
            'terima_suntik' => $request->input('terima_suntik'),
            'terima_akdr' => $request->input('terima_akdr'),
            'terima_impln' => $request->input('terima_impln'),
            'terima_kdm' => $request->input('terima_kdm'),
            'tanggal' => $request->input('tanggal'),
        ];

        if ($request->filled('id')) {
            $pemantauan = Pemantauan::find($request->input('id'));
            if (!$pemantauan) {
                return response()->json(['message' => 'pemantauan not found'], 404);
            }

            $pemantauan->update($pemantauanData);
            $message = 'Pemantauan updated successfully';
        } else {
            Pemantauan::create($pemantauanData);
            $message = 'Pemantauan created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $pemantauan = Pemantauan::find($id);

        if (!$pemantauan) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $pemantauan->delete();

        return response()->json(['message' => 'Data deleted successfully']);
    }
}