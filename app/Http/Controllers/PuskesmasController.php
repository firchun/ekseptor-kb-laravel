<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Puskesmas;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PuskesmasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Puskesmas',
        ];
        return view('puskesmas.index', $data);
    }
    public function puskesmas()
    {
        $data = [
            'title' => 'Setting puskesmas',
            'puskesmas' => Puskesmas::find(Auth::user()->id_puskesmas),
        ];
        return view('puskesmas.setting', $data);
    }
    public function update_puskesmas(Request $request)
    {
        $request->validate([
            'kepala_puskesmas' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'nip_kepala' => 'required|string|max:255',
            'nip_pj' => 'required|string|max:255',
        ]);


        $puskesmas = Puskesmas::findOrFail(Auth::user()->id_puskesmas);
        $puskesmas->kepala_puskesmas = $request->input('kepala_puskesmas');
        $puskesmas->penanggung_jawab = $request->input('penanggung_jawab');
        $puskesmas->nip_kepala = $request->input('nip_kepala');
        $puskesmas->nip_pj = $request->input('nip_pj');

        $puskesmas->save();

        return back()->withSuccess('Berhasil memperbaharui.');
    }
    public function getPuskesmasDataTable()
    {
        $puskesmas = Puskesmas::orderByDesc('id');

        return DataTables::of($puskesmas)
            ->addColumn('action', function ($puskesmas) {
                return view('puskesmas.components.actions', compact('puskesmas'));
            })
            ->addColumn('kelurahan', function ($puskesmas) {
                $kelurahans = Kelurahan::where('id_puskesmas', $puskesmas->id)->get();
                return $kelurahans->pluck('nama_kelurahan')->implode(', ');
            })

            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'alamat_puskesmas' => 'required|string|max:255',
        ]);

        $PuskesmasData = [
            'nama_puskesmas' => $request->input('nama_puskesmas'),
            'alamat_puskesmas' => $request->input('alamat_puskesmas'),
        ];

        if ($request->filled('id')) {
            $Puskesmas = Puskesmas::find($request->input('id'));
            if (!$Puskesmas) {
                return response()->json(['message' => 'Puskesmas not found'], 404);
            }

            $Puskesmas->update($PuskesmasData);
            $message = 'Puskesmas updated successfully';
        } else {
            Puskesmas::create($PuskesmasData);
            $message = 'Puskesmas created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $puskesmas = Puskesmas::find($id);

        if (!$puskesmas) {
            return response()->json(['message' => 'Puskesmas not found'], 404);
        }

        $puskesmas->delete();

        return response()->json(['message' => 'Puskesmas deleted successfully']);
    }
    public function edit($id)
    {
        $Puskesmas = Puskesmas::find($id);

        if (!$Puskesmas) {
            return response()->json(['message' => 'Puskesmas not found'], 404);
        }

        return response()->json($Puskesmas);
    }
}