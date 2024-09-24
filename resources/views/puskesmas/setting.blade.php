@extends('layouts.admin')

@section('main-content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>{{ $title }}</h3>
                </div>
                <form action="{{ route('update_puskesmas.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Kepala Puskesmas</label>
                            <input type="text" class="form-control" name="kepala_puskesmas"
                                value="{{ $puskesmas->kepala_puskesmas }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="">NIP Kepala Puskesmas</label>
                            <input type="number" class="form-control" name="nip_kepala"
                                value="{{ $puskesmas->nip_kepala }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Penanggung Jawab Puskesmas</label>
                            <input type="text" class="form-control" name="penanggung_jawab"
                                value="{{ $puskesmas->penanggung_jawab }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="">NIP Penanggung Jawab Puskesmas</label>
                            <input type="number" class="form-control" name="nip_pj" value="{{ $puskesmas->nip_pj }}"
                                required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
