@extends('layouts.admin')

@section('main-content')
    <div class="dt-action-buttons text-end pt-3 pt-md-0 mb-4">
        <div class=" btn-group " role="group">
            <button class="btn btn-secondary refresh btn-default" type="button">
                <span>
                    <i class="fa fa-rotate me-sm-1"> </i>
                    <span class="d-none d-sm-inline-block"></span>
                </span>
            </button>
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#create">
                <span>
                    <i class="fa fa-plus me-sm-1"> </i>
                    <span class="d-none d-sm-inline-block">Tambah Data</span>
                </span>
            </button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-30">
                <div class="card-header">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="card-body">
                    <table id="datatable-customers" class="table table-hover  display mb-3" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kelurahan</th>
                                <th>Nama</th>
                                <th>Anak</th>
                                <th>NIK</th>
                                <th>NO. BPJS</th>
                                <th>Alat</th>
                                <th>Tanggal Pemakaian</th>
                                <th>Alamat</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Kelurahan</th>
                                <th>Nama</th>
                                <th>Anak</th>
                                <th>NIK</th>
                                <th>NO. BPJS</th>
                                <th>Alat</th>
                                <th>Tanggal Pemakaian</th>
                                <th>Alamat</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('ekseptor.components.modal')
@endsection
@include('ekseptor.script')
