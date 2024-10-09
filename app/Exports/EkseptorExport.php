<?php

namespace App\Exports;

use App\Models\AkseptorItem;
use App\Models\Ekseptor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EkseptorExport implements FromCollection, WithHeadings, WithStartRow, WithStyles
{
    protected $tahun;
    protected $bulan;
    protected $puskesmas;

    public function __construct($tahun, $bulan, $puskesmas)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
        $this->puskesmas = $puskesmas;
    }

    public function collection()
    {
        return AkseptorItem::with(['ekseptor'])
            ->whereYear('tanggal_penggunaan', $this->tahun)
            ->whereMonth('tanggal_penggunaan', $this->bulan)
            ->whereHas('ekseptor', function ($query) {
                $query->where('id_puskesmas', $this->puskesmas);
            })
            ->get()
            ->map(function ($ekseptor) {
                return [
                    'id' => $ekseptor->id,
                    'nama_kelurahan' => $ekseptor->ekseptor->kelurahan->nama_kelurahan ?? null,
                    'nama_puskesmas' => $ekseptor->ekseptor->puskesmas->nama_puskesmas ?? null,
                    'nama' => $ekseptor->ekseptor->nama,
                    'tanggal_lahir' => $ekseptor->ekseptor->tanggal_lahir,
                    'pendidikan' => $ekseptor->ekseptor->pendidikan,
                    'alamat' => $ekseptor->ekseptor->alamat,
                    'jumlah_anak' => $ekseptor->ekseptor->jumlah_anak,
                    'tinggi_badan' => $ekseptor->ekseptor->tinggi_badan,
                    'berat_badan' => $ekseptor->ekseptor->berat_badan,
                    'no_bpjs' => $ekseptor->ekseptor->no_bpjs,
                    'nik' => $ekseptor->ekseptor->nik,
                    'jenis_ras' => $ekseptor->ekseptor->jenis_ras,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kelurahan',
            'Nama Puskesmas',
            'Nama',
            'Tanggal Lahir',
            'Pendidikan',
            'Alamat',
            'Jumlah Anak',
            'Tinggi Badan',
            'Berat Badan',
            'No BPJS',
            'NIK',
            'RAS',
        ];
    }

    public function startRow(): int
    {
        return 2; // Memulai dari baris 2 untuk header di baris 1
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Mengatur gaya untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 14,
                    'color' => ['argb' => Color::COLOR_WHITE],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF4F81BD'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
