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
            @foreach (App\Models\kelurahan::where('id_puskesmas', $puskesmas)->get() as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td></td>
                    <td>{{ $item->nama_kelurahan }}</td>
                    <td>
                        {{ App\Models\Sasaran::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('jumlah') }}
                    </td>
                    <td>
                        {{ App\Models\Sasaran::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('pus_miskin') }}
                    </td>
                    <td>
                        {{ App\Models\Sasaran::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('pus_4t') }}
                    </td>
                    <td>
                        {{ App\Models\Pelayanan::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('kb_aktif') }}
                    </td>
                    <td>0</td>
                    <td>
                        {{ App\Models\Pelayanan::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('komplikasi') }}
                    </td>
                    <td>0</td>
                    <td>
                        {{ App\Models\Pelayanan::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('kegagalan') }}
                    </td>
                    <td>0</td>
                    <td>
                        {{ App\Models\Pelayanan::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('dropout') }}
                    </td>
                    <td>0</td>
                    <td>
                        {{ App\Models\Pelayanan::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('pus_miskin') }}
                    </td>
                    <td>0</td>
                    <td>
                        {{ App\Models\Pelayanan::where('id_puskesmas', $puskesmas)->where('id_kelurahan', $item->id)->sum('pus_4t') }}
                    </td>
                    <td>0</td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_pil') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_suntik') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_akdr') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_impln') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_kdm') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('pengguna_pil') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('pengguna_suntik_1bln') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('pengguna_suntik_3bln') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('pengguna_akdr') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('pengguna_impln') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('pengguna_kdm') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_pil') -
                            App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                    $query->where('id_puskesmas', $puskesmas);
                                })->sum('pengguna_pil') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_suntik') -
                            (App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                    $query->where('id_puskesmas', $puskesmas);
                                })->sum('pengguna_suntik_1bln') +
                                App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                        $query->where('id_puskesmas', $puskesmas);
                                    })->sum('pengguna_suntik_3bln')) }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                $query->where('id_puskesmas', $puskesmas);
                            })->sum('terima_akdr') -
                            App\Models\Pemantauan::where('id_kelurahan', $item->id)->whereHas('kelurahan', function ($query) use ($puskesmas) {
                                    $query->where('id_puskesmas', $puskesmas);
                                })->sum('pengguna_akdr') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('terima_impln') - App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('pengguna_impln') }}
                    </td>
                    <td>
                        {{ App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('terima_kdm') - App\Models\Pemantauan::where('id_kelurahan', $item->id)->sum('pengguna_kdm') }}
                    </td>
                    <td></td>
                </tr>
            @endforeach
            {{-- jumlah --}}
            <tr>
                <td></td>
                <td></td>
                <td>JUMLAH</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
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
