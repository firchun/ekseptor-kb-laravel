<?php

namespace App\Exports;

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
        return Ekseptor::with(['puskesmas', 'alat'])
            ->whereYear('created_at', $this->tahun)
            ->whereMonth('created_at', $this->bulan)
            ->where('id_puskesmas', $this->puskesmas)
            ->get()
            ->map(function ($ekseptor) {
                return [
                    'id' => $ekseptor->id,
                    'nama_kelurahan' => $ekseptor->kelurahan->nama_kelurahan ?? null,
                    'nama_puskesmas' => $ekseptor->puskesmas->nama_puskesmas ?? null,
                    'nama_alat' => $ekseptor->alat->nama_alat ?? null,
                    'nama' => $ekseptor->nama,
                    'tanggal_pemakaian' => $ekseptor->tanggal_pemakaian,
                    'tanggal_lahir' => $ekseptor->tanggal_lahir,
                    'pendidikan' => $ekseptor->pendidikan,
                    'alamat' => $ekseptor->alamat,
                    'jumlah_anak' => $ekseptor->jumlah_anak,
                    'tinggi_badan' => $ekseptor->tinggi_badan,
                    'berat_badan' => $ekseptor->berat_badan,
                    'no_bpjs' => $ekseptor->no_bpjs,
                    'nik' => $ekseptor->nik,
                    'jenis_ras' => $ekseptor->jenis_ras,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kelurahan',
            'Nama Puskesmas',
            'Nama Alat',
            'Nama',
            'Tanggal Pemakaian',
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
