@extends('layouts.admin')

@section('main-content')
    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong></strong> {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.print_pelayanan') }}" enctype="multipart/form-data" method="POST">
                        @method('POST')
                        @csrf
                        <div class="row justify-content-center align-items-center">
                            <div class="col">
                                <div class="mb-3">
                                    <select class="form-control" name="bulan" id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @foreach (App\Models\Pemantauan::selectRaw('YEAR(created_at) as year')->groupBy('year')->orderBy('year', 'desc')->get() as $pemantauan)
                                            <option value="{{ $pemantauan->year }}">{{ $pemantauan->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if (Auth::user()->role == 'Admin')
                                <div class="col">
                                    <div class="mb-3">
                                        <select class="form-control" name="puskesmas" id="puskesmas">
                                            <option value="">Pilih Puskesmas</option>
                                            @foreach (App\Models\Puskesmas::all() as $puskesmas)
                                                <option value="{{ $puskesmas->id }}">{{ $puskesmas->nama_puskesmas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="puskesmas" id="puskesmas"
                                    value="{{ Auth::user()->id_puskesmas }}">
                            @endif
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success" name="action" value="excel"><i
                                        class="fa fa-file-excel"></i> Excel</button>
                                <button type="submit" class="btn btn-danger" name="action" value="pdf"><i
                                        class="fa fa-file-pdf"></i> PDF</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
