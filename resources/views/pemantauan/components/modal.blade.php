<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formCustomerId" name="id">
                    <input type="hidden" name="id_puskesmas" value="{{ Auth::user()->id_puskesmas }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 mx-1 bg-light rouncec p-2 border">
                                <div class="mb-3">
                                    <label for="terima_pil" class="form-label">Kelurahan</label>
                                    <select class="form-control" id="id_kelurahan" name="id_kelurahan" required>
                                        @foreach (App\Models\Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                                </div>
                            </div>
                            <div class="m-1 bg-light rounded p-2 border">
                                <div class="mb-3">
                                    <label for="terima_pil" class="form-label">Penerimaan Pil</label>
                                    <input type="number" class="form-control" id="terima_pil" name="terima_pil"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_suntik" class="form-label">Penerimaan Suntik</label>
                                    <input type="number" class="form-control" id="terima_suntik" name="terima_suntik"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_akdr" class="form-label">Penerimaan AKDR</label>
                                    <input type="number" class="form-control" id="terima_akdr" name="terima_akdr"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_impln" class="form-label">Penerimaan Implant</label>
                                    <input type="number" class="form-control" id="terima_impln" name="terima_impln"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_kdm" class="form-label">Penerimaan KDM</label>
                                    <input type="number" class="form-control" id="terima_kdm" name="terima_kdm"
                                        value="0" required>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <input type="hidden" name="id_puskesmas" value="{{ Auth::user()->id_puskesmas }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3 mx-1 bg-light rouncec p-2 border">
                                <div class="mb-3">
                                    <label for="terima_pil" class="form-label">Kelurahan</label>
                                    <select class="form-control" id="id_kelurahan" name="id_kelurahan" required>
                                        @foreach (App\Models\Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                                </div>
                            </div>
                            <div class="m-1 bg-light rounded p-2 border">
                                <div class="mb-3">
                                    <label for="terima_pil" class="form-label">Penerimaan Pil</label>
                                    <input type="number" class="form-control" id="terima_pil" name="terima_pil"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_suntik" class="form-label">Penerimaan Suntik</label>
                                    <input type="number" class="form-control" id="terima_suntik"
                                        name="terima_suntik" value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_akdr" class="form-label">Penerimaan AKDR</label>
                                    <input type="number" class="form-control" id="terima_akdr" name="terima_akdr"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_impln" class="form-label">Penerimaan Implant</label>
                                    <input type="number" class="form-control" id="terima_impln" name="terima_impln"
                                        value="0" required>
                                </div>
                                <div class="mb-3">
                                    <label for="terima_kdm" class="form-label">Penerimaan KDM</label>
                                    <input type="number" class="form-control" id="terima_kdm" name="terima_kdm"
                                        value="0" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
