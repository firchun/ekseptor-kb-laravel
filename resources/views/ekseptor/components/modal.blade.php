<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ekseptorModalLabel">Update Data Akseptor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="ekseptorForm">
                    <input type="hidden" id="formEkeptorId" name="id">
                    <input type="hidden" id="formEkeptorIdPuskesmas" name="id_puskesmas"
                        value="{{ Auth::user()->id_puskesmas }}">

                    <div class="mb-3">
                        <label for="formAlatKontrasepsi" class="form-label">Alat Kontrasepsi</label>
                        <select class="form-control" id="formAlatKontrasepsi" name="id_alat_kontrasepsi" required>

                            @foreach (App\Models\AlatKontrasepsi::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_alat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formAlatKontrasepsi" class="form-label">Kelurahan</label>
                        <select class="form-control" id="formKelurahan" name="id_kelurahan" required>
                            @foreach (App\Models\Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="formNama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="formTanggalPemakaian" class="form-label">Tanggal Pemakaian</label>
                        <input type="date" class="form-control" id="formTanggalPemakaian" name="tanggal_pemakaian"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="formTanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="formTanggalLahir" name="tanggal_lahir" required>
                    </div>

                    <div class="mb-3">
                        <label for="formPendidikan" class="form-label">Pendidikan</label>
                        <input type="text" class="form-control" id="formPendidikan" name="pendidikan" required>
                    </div>

                    <div class="mb-3">
                        <label for="formAlamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="formAlamat" name="alamat" required>
                    </div>

                    <div class="mb-3">
                        <label for="formJumlahAnak" class="form-label">Jumlah Anak</label>
                        <input type="number" class="form-control" id="formJumlahAnak" name="jumlah_anak" required>
                    </div>

                    <div class="mb-3">
                        <label for="formTinggiBadan" class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" class="form-control" id="formTinggiBadan" name="tinggi_badan" required>
                    </div>

                    <div class="mb-3">
                        <label for="formBeratBadan" class="form-label">Berat Badan (kg)</label>
                        <input type="number" class="form-control" id="formBeratBadan" name="berat_badan" required>
                    </div>

                    <div class="mb-3">
                        <label for="formNoBpjs" class="form-label">No BPJS</label>
                        <input type="text" class="form-control" id="formNoBpjs" name="no_bpjs" required>
                    </div>

                    <div class="mb-3">
                        <label for="formNik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="formNik" name="nik" required>
                    </div>

                    <div class="mb-3">
                        <label for="formJenisRas" class="form-label">Jenis Ras</label>
                        <select class="form-control" id="formJenisRas" name="jenis_ras" required>
                            <option value="OAP">OAP</option>
                            <option value="NON-OAP">NON-OAP</option>
                        </select>
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
<!-- Modal for Create and Edit -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ekseptorModalLabel">Tambah Akseptor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createEkseptorForm">
                    <input type="hidden" name="id_puskesmas" value="{{ Auth::user()->id_puskesmas }}">
                    <div class="mb-3">
                        <label for="formAlatKontrasepsi" class="form-label">Alat Kontrasepsi</label>
                        <select class="form-control" id="formAlatKontrasepsi" name="id_alat_kontrasepsi" required>
                            @foreach (App\Models\AlatKontrasepsi::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_alat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formAlatKontrasepsi" class="form-label">Kelurahan</label>
                        <select class="form-control" id="formKelurahan" name="id_kelurahan" required>
                            @foreach (App\Models\Kelurahan::where('id_puskesmas', Auth::user()->id_puskesmas)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelurahan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="createFormNama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="formTanggalPemakaian" class="form-label">Tanggal Pemakaian</label>
                        <input type="date" class="form-control" id="createFormTanggalPemakaian"
                            name="tanggal_pemakaian" required>
                    </div>

                    <div class="mb-3">
                        <label for="formTanggalLahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="createFormTanggalLahir" name="tanggal_lahir"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="formPendidikan" class="form-label">Pendidikan</label>
                        <input type="text" class="form-control" id="createFormPendidikan" name="pendidikan"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="formAlamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="createFormAlamat" name="alamat" required>
                    </div>

                    <div class="mb-3">
                        <label for="formJumlahAnak" class="form-label">Jumlah Anak</label>
                        <input type="number" class="form-control" id="createFormJumlahAnak" name="jumlah_anak"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="formTinggiBadan" class="form-label">Tinggi Badan (cm)</label>
                        <input type="number" class="form-control" id="createFormTinggiBadan" name="tinggi_badan"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="formBeratBadan" class="form-label">Berat Badan (kg)</label>
                        <input type="number" class="form-control" id="createFormBeratBadan" name="berat_badan"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="formNoBpjs" class="form-label">No BPJS</label>
                        <input type="text" class="form-control" id="createFormNoBpjs" name="no_bpjs" required>
                    </div>

                    <div class="mb-3">
                        <label for="formNik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="createFormNik" name="nik" required>
                    </div>

                    <div class="mb-3">
                        <label for="formJenisRas" class="form-label">Jenis Ras</label>
                        <select class="form-control" id="createFormJenisRas" name="jenis_ras" required>
                            <option value="OAP">OAP</option>
                            <option value="NON-OAP">NON-OAP</option>
                        </select>
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
