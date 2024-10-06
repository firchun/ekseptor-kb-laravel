<?php

namespace App\Http\Controllers;

use App\Models\AkseptorItem;
use App\Models\Ekseptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EkseptorController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Akseptor',
        ];
        return view('ekseptor.index', $data);
    }
    public function getEkseptorDataTable()
    {
        $ekseptor = Ekseptor::with(['kelurahan'])->orderByDesc('id');
        if (Auth::user()->role != 'Admin') {
            $ekseptor->where('id_puskesmas', Auth::user()->id_puskesmas);
        }

        return DataTables::of($ekseptor)
            ->addColumn('action', function ($ekseptor) {
                return view('ekseptor.components.actions', compact('ekseptor'));
            })
            ->addColumn('action_pemantuan', function ($ekseptor) {
                return view('pemantauan_akseptor.components.actions', compact('ekseptor'));
            })

            ->rawColumns(['action', 'action_pemantuan'])
            ->make(true);
    }
    public function store(Request $request)
    {
        // Validasi input sesuai dengan kolom di tabel ekseptor
        $request->validate([
            'id_puskesmas' => 'required|exists:puskesmas,id',
            'id_kelurahan' => 'required|exists:kelurahan,id',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jumlah_anak' => 'required|integer',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|integer',
            'no_bpjs' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'jenis_ras' => 'required|in:OAP,NON-OAP',
        ]);

        // Mengambil data dari request
        $ekseptorData = [
            'id_puskesmas' => $request->input('id_puskesmas'),
            'id_kelurahan' => $request->input('id_kelurahan'),
            'nama' => $request->input('nama'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'pendidikan' => $request->input('pendidikan'),
            'alamat' => $request->input('alamat'),
            'jumlah_anak' => $request->input('jumlah_anak'),
            'tinggi_badan' => $request->input('tinggi_badan'),
            'berat_badan' => $request->input('berat_badan'),
            'no_bpjs' => $request->input('no_bpjs'),
            'nik' => $request->input('nik'),
            'jenis_ras' => $request->input('jenis_ras'),
        ];

        // Memeriksa apakah ada ID untuk update atau create
        if ($request->filled('id')) {
            $ekseptor = Ekseptor::find($request->input('id'));
            if (!$ekseptor) {
                return response()->json(['message' => 'ekseptor not found'], 404);
            }

            $ekseptor->update($ekseptorData);
            $message = 'ekseptor updated successfully';
        } else {
            Ekseptor::create($ekseptorData);
            $message = 'ekseptor created successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function destroy($id)
    {
        $ekseptor = Ekseptor::find($id);

        if (!$ekseptor) {
            return response()->json(['message' => 'ekseptor not found'], 404);
        } else {
            $item = AkseptorItem::where('id_ekseptor', $id)->get();
            foreach ($item as $i) {
                $i->delete();
            }
        }

        $ekseptor->delete();

        return response()->json(['message' => 'ekseptor deleted successfully']);
    }
    public function edit($id)
    {
        $ekseptor = Ekseptor::find($id);

        if (!$ekseptor) {
            return response()->json(['message' => 'ekseptor not found'], 404);
        }

        return response()->json($ekseptor);
    }
}
