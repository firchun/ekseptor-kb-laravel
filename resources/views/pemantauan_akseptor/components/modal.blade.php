<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ekseptorModalLabel">Tambah Data Pemantauan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->

                <form id="tambahPemantauan">
                    <input type="hidden" name="id_ekseptor" id="idEkseptor">
                    <div class="mb-3">
                        <label>Tanggal Penggunaan</label>
                        <input type="date" name="tanggal_penggunaan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Pilih Alat Kontrasepsi digunakan</label>
                        <select id="penggunaan" class="form-control" name="penggunaan">
                            <option value="pil">Pil</option>
                            <option value="suntik_1bln">Suntik 1 Bulan</option>
                            <option value="suntik_3bln">Suntik 3 Bulan</option>
                            <option value="akdr">AKDR</option>
                            <option value="impln">Implan</option>
                            <option value="kndm">Kondom</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-block"
                            id="btnTambahPemantauan">Simpan</button>
                    </div>
                </form>
                <hr>
                <table class="table table-hover table-bordered" id="datatable-ekseptor-pemantauan" style="width: 100%;">
                    <thead>
                        <th>ID</th>
                        <th>Tanggal pemakaian</th>
                        <th>Alat Kontrasepsi</th>
                        <th>Hapus</th>
                    </thead>
                    <tfoot>
                        <th>ID</th>
                        <th>Tanggal pemakaian</th>
                        <th>Alat Kontrasepsi</th>
                        <th>Hapus</th>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
