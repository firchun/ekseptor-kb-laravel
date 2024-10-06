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
            <button class="btn btn-secondary create-new" type="button" data-bs-toggle="modal" data-bs-target="#create">
                <span>
                    <i class="fa fa-plus me-sm-1"> </i>
                    <span class="d-none d-sm-inline-block">Tambah Data Penerimaan</span>
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
                    <table id="datatable-customers" class="table-bordered table-hover  display mb-3" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">NO</th>
                                <th rowspan="2">Tanggal</th>
                                <th rowspan="2">KELURAHAN</th>
                                <th colspan="5">PENERIMAAN</th>
                                <th rowspan="2">Delete</th>
                            </tr>
                            <tr class="text-center">
                                <th>PIL</th>
                                <th>SUNTIK</th>
                                <th>AKDR</th>
                                <th>IMPLN</th>
                                <th>KDM</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pemantauan.components.modal')
@endsection
@include('pemantauan.script')
