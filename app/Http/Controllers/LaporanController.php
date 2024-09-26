<?php

namespace App\Http\Controllers;

use App\Exports\EkseptorExport;
use App\Models\Ekseptor;
use App\Models\Puskesmas;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;

class LaporanController extends Controller
{
    public function pelayanan()
    {
        $data = [
            'title' => 'Laporan Pelayanan Keluarga Berencana'
        ];
        return view('laporan.pelayanan', $data);
    }
    public function ekseptor()
    {
        $data = [
            'title' => 'Laporan Data Ekseptor'
        ];
        return view('laporan.ekseptor', $data);
    }
    public function print_ekseptor(Request $request)
    {
        $action = $request->input('action');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        if (empty($bulan) || empty($tahun)) {
            return back()->with('danger', 'Harap mengisi form');
        }
        if ($action == 'excel') {
            return Excel::download(new EkseptorExport($tahun, $bulan), 'laporan-ekseptor-' . $bulan . $tahun . '.xlsx');
        } else {

            $ekseptors = Ekseptor::with(['puskesmas', 'alat'])
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan);
            if (Auth::user()->role != 'Admin') {
                $ekseptors->where('id_puskesmas', Auth::user()->id_puskesmas);
            }
            $ekseptors->get();
            $oap = $ekseptors->where('jenis_ras', 'OAP')->count();
            $non_oap = $ekseptors->where('jenis_ras', 'NON-OAP')->count();

            $pdf = PDF::loadView('laporan.pdf.pdf_ekseptor', compact('ekseptors', 'bulan', 'tahun', 'oap', 'non_oap'))->setPaper('A4', 'landscape');
            return $pdf->download('laporan-akseptor-' . $bulan . $tahun . '.pdf');
        }
    }
    public function print_pelayanan(Request $request)
    {
        $action = $request->input('action');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $puskesmas = $request->input('puskesmas');
        if (empty($bulan) || empty($tahun) || empty($puskesmas)) {
            return back()->with('danger', 'Harap mengisi form');
        }
        if ($action == 'excel') {
            // return Excel::download(new EkseptorExport($tahun, $bulan), 'laporan-ekseptor-' . $bulan . $tahun . '.xlsx');
        } else {


            $data_puskesmas = Puskesmas::find($puskesmas);
            $pdf = PDF::loadView('laporan.pdf.pdf_pelayanan', compact('data_puskesmas', 'tahun', 'bulan', 'puskesmas'))->setPaper('A4', 'landscape');
            return $pdf->download('laporan-pelayanan-kb-' . $bulan . $tahun . '.pdf');
        }
    }
}