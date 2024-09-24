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
                    <select class="form-control" id="formIdKelurahan" name="id_kelurahan" required>
                        @foreach (App\Models\Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <label for="formPusMiskin" class="form-label">Pus Miskin</label>
                        <input type="number" class="form-control" id="formPusMiskin" name="pus_miskin" required>
                    </div>
                    <div class="mb-3">
                        <label for="formPus4T" class="form-label">Pus 4T</label>
                        <input type="number" class="form-control" id="formPus4T" name="pus_4t" required>
                    </div>
                    <div class="mb-3">
                        <label for="formJumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="formJumlah" name="jumlah" required>
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
                <!-- Form for Create -->
                <form id="createUserForm">
                    <input type="hidden" name="id_puskesmas" value="{{ Auth::user()->id_puskesmas }}">
                    <div class="mb-3">
                        <label for="formIdKelurahanCreate" class="form-label">ID Kelurahan</label>
                        <select class="form-control" id="formIdKelurahanCreate" name="id_kelurahan" required>
                            @foreach (App\Models\Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formPusMiskinCreate" class="form-label">Pus Miskin</label>
                        <input type="number" class="form-control" id="formPusMiskinCreate" name="pus_miskin" required>
                    </div>
                    <div class="mb-3">
                        <label for="formPus4TCreate" class="form-label">Pus 4T</label>
                        <input type="number" class="form-control" id="formPus4TCreate" name="pus_4t" required>
                    </div>
                    <div class="mb-3">
                        <label for="formJumlahCreate" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="formJumlahCreate" name="jumlah" required>
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
