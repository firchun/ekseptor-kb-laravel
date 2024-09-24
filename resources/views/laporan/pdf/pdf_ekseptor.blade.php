<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Akseptor</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4F81BD;
            color: white;
        }

        .signature-section {
            margin-top: 30px;
            /* Jarak dari tabel */
        }

        .signature {
            width: 40%;
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
    <h1 style="text-align: center;">Laporan Data Akseptor</h1>
    <p>BULAN : {{ \Carbon\Carbon::create()->month($bulan)->format('F') }}<br> TAHUN : {{ $tahun }}
        <br>OAP : {{ $oap }}
        <br>NON-OAP : {{ $non_oap }}
    </p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Puskesmas</th>
                <th>Nama Alat</th>
                <th>Nama</th>
                <th>Tanggal Pemakaian</th>
                <th>Tanggal Lahir</th>
                <th>Pendidikan</th>
                <th>Alamat</th>
                <th>Jumlah Anak</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>No BPJS</th>
                <th>NIK</th>
                <th>RAS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ekseptors as $ekseptor)
                <tr>
                    <td>{{ $ekseptor->id }}</td>
                    <td>{{ $ekseptor->puskesmas->nama_puskesmas ?? 'N/A' }}</td>
                    <td>{{ $ekseptor->alat->nama_alat ?? 'N/A' }}</td>
                    <td>{{ $ekseptor->nama }}</td>
                    <td>{{ $ekseptor->tanggal_pemakaian }}</td>
                    <td>{{ $ekseptor->tanggal_lahir }}</td>
                    <td>{{ $ekseptor->pendidikan }}</td>
                    <td>{{ $ekseptor->alamat }}</td>
                    <td>{{ $ekseptor->jumlah_anak }}</td>
                    <td>{{ $ekseptor->tinggi_badan }}</td>
                    <td>{{ $ekseptor->berat_badan }}</td>
                    <td>{{ $ekseptor->no_bpjs }}</td>
                    <td>{{ $ekseptor->nik }}</td>
                    <td>{{ $ekseptor->jenis_ras }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="signature-section clearfix">
        <div class="signature">
            <p>Mengetahui,<br>Kepala Puskesmas</p>
            <p style="margin-top: 70px;">Nama Penandatangan 1<br>NIP.</p>
        </div>
        <div class="signature right">
            <p>Merauke, {{ date('d F Y') }}<br>Penanggung Jawab KB</p>
            <p style="margin-top: 70px;">Nama Penandatangan 2<br>NIP.</p>
        </div>
    </div> --}}
</body>

</html>
