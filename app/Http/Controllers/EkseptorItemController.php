<?php

namespace App\Http\Controllers;

use App\Models\AkseptorItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EkseptorItemController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Pengguanaan Alat Kontrasepsi',
        ];
        return view('pemantauan_akseptor.index', $data);
    }
    public function getAkseptorItemDataTable($id)
    {
        $ekseptor = AkseptorItem::with(['ekseptor'])->where('id_ekseptor', $id)->orderByDesc('id');

        return DataTables::of($ekseptor)
            ->addColumn('action', function ($ekseptor) {
                return '<button class="btn btn-sm btn-danger" onclick="deleteData(' . $ekseptor->id . ')">hapus</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_ekseptor' => 'required|exists:ekseptor,id',
            'tanggal_penggunaan' => 'required|date',
            'penggunaan' => 'required|string',

        ]);

        $kelurahanData = [
            'penggunaan' => $request->input('penggunaan'),
            'id_ekseptor' => $request->input('id_ekseptor'),
            'tanggal_penggunaan' => $request->input('tanggal_penggunaan'),
        ];

        if ($request->filled('id')) {
            $kelurahan = AkseptorItem::find($request->input('id'));
            if (!$kelurahan) {
                return response()->json(['message' => 'data not found'], 404);
            }

            $kelurahan->update($kelurahanData);
            $message = 'data updated successfully';
        } else {
            AkseptorItem::create($kelurahanData);
            $message = 'data created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $ekseptor = AkseptorItem::find($id);

        if (!$ekseptor) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $ekseptor->delete();

        return response()->json(['message' => 'data deleted successfully']);
    }
}
