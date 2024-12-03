<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN PELAYANAN KELUARGA BERENCANA</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 6px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        th {
            color: black;
        }

        .signature-section {
            margin-top: 30px;
            /* Jarak dari tabel */
        }

        .signature {
            font-size: 10px;
            width: 20%;
            /* Lebar area tanda tangan */
            /* Garis tanda tangan */
            text-align: left;
            /* Pusatkan teks */
            padding-top: 10px;
            /* Jarak atas teks tanda tangan */
            float: left;
            /* Mengatur posisi ke kiri */
        }

        .signature.right {
            float: right;
            /* Mengatur posisi ke kanan */
        }

        /* Clearfix untuk menghindari masalah dengan float */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center;">LAPORAN PELAYANAN KELUARGA BERENCANA</h3>
    <p>PUSKESMAS : {{ $data_puskesmas->nama_puskesmas }}
        <br>
        BULAN : {{ \Carbon\Carbon::create()->month($bulan)->format('F') }}<br> TAHUN : {{ $tahun }}

    </p>
    <table>
        <thead>
            <tr class="text-center">
                <th rowspan="3">NO</th>
                <th rowspan="3">KODE</th>
                <th rowspan="1">KELURAHAN</th>
                <th colspan="3">SASARAN</th>
                <th colspan="12">PELAYANAN KELUARGA BERENCANA</th>
                <th colspan="16">PEMANTAUAN PERSEDIAAN ALAT KONTRASEPSI</th>
                <th rowspan="3">DATA TERAKHIR BULAN</th>
            </tr>
            <tr>
                <th rowspan="2">KAMPUNG</th>
                <th rowspan="2">JML PUS</th>
                <th colspan="2">JML PUS</th>
                <th colspan="2">KB AKTIF</th>
                <th colspan="2">KOMPLIKASI</th>
                <th colspan="2">KEGAGALAN</th>
                <th colspan="2">DROP OUT</th>
                <th colspan="2">PUS MISKIN ber KB</th>
                <th colspan="2">PUS 4T ber KB</th>
                <th colspan="5">PENERIMAAN</th>
                <th colspan="6">PENGGUNAAN</th>
                <th colspan="5">SISA</th>
            </tr>
            <tr class="text-center">
                <th>MISKIN</th>
                <th>4T</th>
                <th>ABS</th>
                <th>%</th>
                <th>ABS</th>
                <th>%</th>
                <th>ABS</th>
                <th>%</th>
                <th>ABS</th>
                <th>%</th>
                <th>ABS</th>
                <th>%</th>
                <th>ABS</th>
                <th>%</th>
                <th>PIL</th>
                <th>SUNTIK</th>
                <th>AKDR</th>
                <th>IMPLN</th>
                <th>KDM</th>
                <th>PIL</th>
                <th>SUNTIK 1 BLN</th>
                <th>SUNTIK 3 BLN</th>
                <th>AKDR</th>
                <th>IMPLN</th>
                <th>KDM</th>
                <th>PIL</th>
                <th>SUNTIK</th>
                <th>AKDR</th>
                <th>IMPLN</th>
                <th>KDM</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalJumlah = 0;
                $totalPusMiskin = 0;
                $totalPus4T = 0;
                $totalKbAktif = 0;
                $totalKomplikasi = 0;
                $totalKegagalan = 0;
                $totalDropout = 0;
                $totalPusMiskinBerKb = 0;
                $totalPus4TBerKb = 0;
                $totalPenerimaanPil = 0;
                $totalPenerimaanSuntik = 0;
                $totalPenerimaanAkdr = 0;
                $totalPenerimaanImpln = 0;
                $totalPenerimaanKndm = 0;
                //penggunaan
                $totalPenggunaanPil = 0;
                $totalPenggunaanSuntik1Bln = 0;
                $totalPenggunaanSuntik3Bln = 0;
                $totalPenggunaanAkdr = 0;
                $totalPenggunaanImpln = 0;
                $totalPenggunaanKndm = 0;
                //sisa
                $totalSisaPil = 0;
                $totalSisaSuntik = 0;
                $totalSisaAkdr = 0;
                $totalSisaImpln = 0;
                $totalSisaKndm = 0;

            @endphp

            @foreach (App\Models\Kelurahan::where('id_puskesmas', $puskesmas)->get() as $item)
                @php
                    $jumlah = App\Models\Sasaran::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->sum('jumlah');
                    $pusMiskin = App\Models\Sasaran::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->sum('pus_miskin');
                    $pus4T = App\Models\Sasaran::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->sum('pus_4t');
                    $kbAktif = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->count();
                    $komplikasi = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->sum('komplikasi');
                    $kegagalan = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->sum('kegagalan');
                    $dropout = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->sum('dropout');
                    $pusMiskinBerKb = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->sum('pus_miskin');
                    $pus4TBerKb = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                        ->where('id_kelurahan', $item->id)
                        ->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', $tahun)
                        ->sum('pus_4t');

                    $penggunaanPil = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use (
                        $item,
                        $puskesmas,
                    ) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->where('penggunaan', 'pil')
                        ->count();

                    $penggunaanSuntik1Bln = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use (
                        $item,
                        $puskesmas,
                    ) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->whereIn('penggunaan', ['suntik_1bln'])
                        ->count();
                    $penggunaanSuntik3Bln = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use (
                        $item,
                        $puskesmas,
                    ) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->whereIn('penggunaan', ['suntik_3bln'])
                        ->count();

                    $penggunaanAkdr = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use (
                        $item,
                        $puskesmas,
                    ) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->where('penggunaan', 'akdr')
                        ->count();

                    $penggunaanImpln = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use (
                        $item,
                        $puskesmas,
                    ) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->where('penggunaan', 'impln')
                        ->count();

                    $penggunaanKndm = App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use (
                        $item,
                        $puskesmas,
                    ) {
                        $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                    })
                        ->whereMonth('tanggal_penggunaan', $bulan)
                        ->whereYear('tanggal_penggunaan', $tahun)
                        ->where('penggunaan', 'kndm')
                        ->count();
                    //kondisi sebelumnya
                    if ($bulan == 1) {
                        $bulan_sebelumnya = 12;
                        $tahun_sebelumnya = $tahun - 1;
                    } else {
                        $bulan_sebelumnya = $bulan - 1;
                        $tahun_sebelumnya = $tahun;
                    }
                    $sisaPilSebelumnya =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->sum('terima_pil') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan_sebelumnya)
                            ->whereYear('tanggal_penggunaan', $tahun_sebelumnya)
                            ->where('penggunaan', 'pil')
                            ->count();
                    $sisaSuntikSebelumnya =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })

                            ->sum('terima_suntik') -
                        (App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan_sebelumnya)
                            ->whereYear('tanggal_penggunaan', $tahun_sebelumnya)
                            ->where('penggunaan', 'suntik_1bln')
                            ->count() +
                            App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                                $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                            })
                                ->whereMonth('tanggal_penggunaan', $bulan)
                                ->whereYear('tanggal_penggunaan', $tahun)
                                ->where('penggunaan', 'suntik_3bln')
                                ->count());
                    $sisaAkdrSebelumnya =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })

                            ->sum('terima_akdr') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan_sebelumnya)
                            ->whereYear('tanggal_penggunaan', $tahun_sebelumnya)
                            ->where('penggunaan', 'akdr')
                            ->count();

                    $sisaImplnSebelumnya =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('terima_impln') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan_sebelumnya)
                            ->whereYear('tanggal_penggunaan', $tahun_sebelumnya)
                            ->where('penggunaan', 'impln')
                            ->count();
                    $sisaKndmSebelumnya =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('terima_kdm') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan_sebelumnya)
                            ->whereYear('tanggal_penggunaan', $tahun_sebelumnya)
                            ->where('penggunaan', 'kndm')
                            ->count();

                    //sisa sebenarnya
                    $sisaPil =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->sum('terima_pil') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan)
                            ->whereYear('tanggal_penggunaan', $tahun)
                            ->where('penggunaan', 'pil')
                            ->count();
                    $sisaSuntik =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })

                            ->sum('terima_suntik') -
                        (App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan)
                            ->whereYear('tanggal_penggunaan', $tahun)
                            ->where('penggunaan', 'suntik_1bln')
                            ->count() +
                            App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                                $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                            })
                                ->whereMonth('tanggal_penggunaan', $bulan)
                                ->whereYear('tanggal_penggunaan', $tahun)
                                ->where('penggunaan', 'suntik_3bln')
                                ->count());
                    $sisaAkdr =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })

                            ->sum('terima_akdr') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan)
                            ->whereYear('tanggal_penggunaan', $tahun)
                            ->where('penggunaan', 'akdr')
                            ->count();

                    $sisaImpln =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('terima_impln') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan)
                            ->whereYear('tanggal_penggunaan', $tahun)
                            ->where('penggunaan', 'impln')
                            ->count();
                    $sisaKndm =
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('terima_kdm') -
                        App\Models\AkseptorItem::whereHas('ekseptor', function ($query) use ($item, $puskesmas) {
                            $query->where('id_kelurahan', $item->id)->where('id_puskesmas', $puskesmas);
                        })
                            ->whereMonth('tanggal_penggunaan', $bulan)
                            ->whereYear('tanggal_penggunaan', $tahun)
                            ->where('penggunaan', 'kndm')
                            ->count();

                    //penerimaan
                    $penerimaanPil =
                        $sisaPilSebelumnya +
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->sum('terima_pil');

                    $penerimaanSuntik =
                        $sisaSuntikSebelumnya +
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->sum('terima_suntik');

                    $penerimaanAkdr =
                        $sisaAkdrSebelumnya +
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->sum('terima_akdr');

                    $penerimaanImpln =
                        $sisaImplnSebelumnya +
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->sum('terima_impln');

                    $penerimaanKndm =
                        $sisaKndmSebelumnya +
                        App\Models\Pemantauan::where('id_kelurahan', $item->id)
                            ->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->sum('terima_kdm');

                    // jumlah
                    $totalJumlah += $jumlah;
                    $totalPusMiskin += $pusMiskin;
                    $totalPus4T += $pus4T;
                    $totalKbAktif += $kbAktif;
                    $totalKomplikasi += $komplikasi;
                    $totalKegagalan += $kegagalan;
                    $totalDropout += $dropout;
                    $totalPusMiskinBerKb += $pusMiskinBerKb;
                    $totalPus4TBerKb += $pus4TBerKb;
                    //penerimaan
                    $totalPenerimaanPil += $penerimaanPil;
                    $totalPenerimaanSuntik += $penerimaanSuntik;
                    $totalPenerimaanAkdr += $penerimaanAkdr;
                    $totalPenerimaanImpln += $penerimaanImpln;
                    $totalPenerimaanKndm += $penerimaanKndm;
                    //penggunaan
                    $totalPenggunaanPil += $penggunaanPil;
                    $totalPenggunaanSuntik1Bln += $penggunaanSuntik1Bln;
                    $totalPenggunaanSuntik3Bln += $penggunaanSuntik3Bln;
                    $totalPenggunaanAkdr += $penggunaanAkdr;
                    $totalPenggunaanImpln += $penggunaanImpln;
                    $totalPenggunaanKndm += $penggunaanKndm;
                    //sisa
                    $totalSisaPil += $sisaPil;
                    $totalSisaSuntik += $sisaSuntik;
                    $totalSisaAkdr += $sisaAkdr;
                    $totalSisaImpln += $sisaImpln;
                    $totalSisaKndm += $sisaKndm;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td></td>
                    <td>{{ $item->nama_kelurahan }}</td>
                    <td>
                        {{ $jumlah }}
                    </td>
                    <td>
                        {{ $pusMiskin }}
                    </td>
                    <td>
                        {{ $pus4T }}
                    </td>
                    <td>
                        {{ $kbAktif }}
                    </td>
                    <td>
                        @php
                            $jumlah = App\Models\Sasaran::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->sum('jumlah');
                            $kb_aktif = App\Models\Ekseptor::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->whereYear('created_at', $tahun)
                                ->whereMonth('created_at', $bulan)
                                ->count();
                            $persentase_kb_aktif = 0;
                            if ($jumlah > 0) {
                                $persentase_kb_aktif = ($kb_aktif / $jumlah) * 100;
                            }
                        @endphp
                        {{ number_format($persentase_kb_aktif, 2, '.', '') }}
                    </td>
                    <td>
                        {{ $komplikasi }}
                    </td>
                    <td>
                        @php

                            $komplikasi = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->sum('komplikasi');
                            $persentase_komplikasi = 0;
                            if ($jumlah > 0) {
                                $persentase_komplikasi = ($komplikasi / $jumlah) * 100;
                            }
                        @endphp
                        {{ number_format($persentase_komplikasi, 2, '.', '') }}
                    </td>
                    <td>
                        {{ $kegagalan }}
                    </td>
                    <td>
                        @php

                            $kegagalan = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->sum('kegagalan');
                            $persentase_kegagalan = 0;
                            if ($jumlah > 0) {
                                $persentase_kegagalan = ($kegagalan / $jumlah) * 100;
                            }
                        @endphp
                        {{ number_format($persentase_kegagalan, 2, '.', '') }}
                    </td>
                    <td>
                        {{ $dropout }}
                    </td>
                    <td>
                        @php

                            $dropout = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->sum('dropout');
                            $persentase_dropout = 0;
                            if ($jumlah > 0) {
                                $persentase_dropout = ($dropout / $jumlah) * 100;
                            }
                        @endphp
                        {{ number_format($persentase_dropout, 2, '.', '') }}
                    </td>
                    <td>
                        {{ $pusMiskinBerKb }}
                    </td>
                    <td>
                        @php

                            $pus_miskin = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->sum('pus_miskin');
                            $persentase_pus_miskin = 0;
                            if ($jumlah > 0) {
                                $persentase_pus_miskin = ($pus_miskin / $jumlah) * 100;
                            }
                        @endphp
                        {{ number_format($persentase_pus_miskin, 2, '.', '') }}
                    </td>
                    <td>
                        {{ $pus4TBerKb }}
                    </td>
                    <td>
                        @php

                            $pus_4t = App\Models\Pelayanan::where('id_puskesmas', $puskesmas)
                                ->where('id_kelurahan', $item->id)
                                ->sum('pus_4t');
                            $persentase_pus_4t = 0;
                            if ($jumlah > 0) {
                                $persentase_pus_4t = ($pus_4t / $jumlah) * 100;
                            }
                        @endphp
                        {{ number_format($persentase_pus_4t, 2, '.', '') }}
                    </td>
                    <td>
                        {{ $penerimaanPil }}
                    </td>
                    <td>
                        {{ $penerimaanSuntik }}
                    </td>
                    <td>
                        {{ $penerimaanAkdr }}
                    </td>
                    <td>
                        {{ $penerimaanImpln }}
                    </td>
                    <td>
                        {{ $penerimaanKndm }}
                    </td>
                    <td>
                        {{ $penggunaanPil }}
                    </td>
                    <td>
                        {{ $penggunaanSuntik1Bln }}
                    </td>
                    <td>
                        {{ $penggunaanSuntik3Bln }}
                    </td>
                    <td>
                        {{ $penggunaanAkdr }}
                    </td>
                    <td>
                        {{ $penggunaanImpln }}
                    </td>
                    <td>
                        {{ $penggunaanKndm }}
                    </td>
                    <td>
                        {{ $sisaPil }}
                    </td>
                    <td>
                        {{ $sisaSuntik }}
                    </td>
                    <td>
                        {{ $sisaAkdr }}
                    </td>
                    <td>
                        {{ $sisaImpln }}
                    </td>
                    <td>
                        {{ $sisaKndm }}
                    </td>
                    <td></td>
                </tr>
            @endforeach
            {{-- jumlah --}}
            <tr>
                <td></td>
                <td></td>
                <td>JUMLAH</td>
                <td>{{ $totalJumlah }}</td>
                <td>{{ $totalPusMiskin }}</td>
                <td>{{ $totalPus4T }}</td>
                <td>{{ $totalKbAktif }}</td>
                <td>-</td>
                <td>{{ $totalKomplikasi }}</td>
                <td>-</td>
                <td>{{ $totalKegagalan }}</td>
                <td>-</td>
                <td>{{ $totalDropout }}</td>
                <td>-</td>
                <td>{{ $totalPusMiskinBerKb }}</td>
                <td>-</td>
                <td>{{ $totalPus4TBerKb }}</td>
                <td>-</td>
                <td>{{ $totalPenerimaanPil }}</td>
                <td>{{ $totalPenerimaanSuntik }}</td>
                <td>{{ $totalPenerimaanAkdr }}</td>
                <td>{{ $totalPenerimaanImpln }}</td>
                <td>{{ $totalPenerimaanKndm }}</td>
                <td>{{ $totalPenggunaanPil }}</td>
                <td>{{ $totalPenggunaanSuntik1Bln }}</td>
                <td>{{ $totalPenggunaanSuntik3Bln }}</td>
                <td>{{ $totalPenggunaanAkdr }}</td>
                <td>{{ $totalPenggunaanImpln }}</td>
                <td>{{ $totalPenggunaanKndm }}</td>
                <td>{{ $totalSisaPil }}</td>
                <td>{{ $totalSisaSuntik }}</td>
                <td>{{ $totalSisaAkdr }}</td>
                <td>{{ $totalSisaImpln }}</td>
                <td>{{ $totalSisaKndm }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section clearfix">
        <div class="signature">
            <p>Mengetahui,<br>Kepala {{ $data_puskesmas->nama_puskesmas }}</p>
            <p style="margin-top: 70px;">
                {{ $data_puskesmas->kepala_puskesmas }}<br>NIP.{{ $data_puskesmas->nip_kepala }}</p>
        </div>
        <div class="signature right">
            <p>Merauke, {{ date('d F Y') }}<br>Penanggung Jawab KB</p>
            <p style="margin-top: 70px;"> {{ $data_puskesmas->penanggung_jawab }}<br>NIP.{{ $data_puskesmas->nip_pj }}
            </p>
        </div>
    </div>
</body>

</html>
