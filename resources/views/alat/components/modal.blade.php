<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Data</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="formCustomerId" name="id">
                    <div class="mb-3">
                        <label for="formKodeAlat" class="form-label">Kode Alat</label>
                        <input type="text" class="form-control" id="formKodeAlat" name="kode_alat" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFotoAlat" class="form-label">Foto Alat</label>
                        <input type="file" class="form-control" id="formFotoAlat" name="foto_alat">
                    </div>
                    <div class="mb-3">
                        <label for="formNamaAlat" class="form-label">Nama Alat</label>
                        <input type="text" class="form-control" id="formNamaAlat" name="nama_alat" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCaraPakai" class="form-label">Cara Pakai</label>
                        <textarea class="form-control" id="formCaraPakai" name="cara_pakai" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formKelebihan" class="form-label">Kelebihan</label>
                        <textarea class="form-control" id="formKelebihan" name="kelebihan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formKekurangan" class="form-label">Kekurangan</label>
                        <textarea class="form-control" id="formKekurangan" name="kekurangan" required></textarea>
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

<!-- Modal for Create -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <!-- Form for Create -->
                <form id="createUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formKodeAlat" class="form-label">Kode Alat</label>
                        <input type="text" class="form-control" id="formKodeAlat" name="kode_alat" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFotoAlat" class="form-label">Foto Alat</label>
                        <input type="file" class="form-control" id="formFotoAlat" name="foto_alat">
                    </div>
                    <div class="mb-3">
                        <label for="formNamaAlat" class="form-label">Nama Alat</label>
                        <input type="text" class="form-control" id="formNamaAlat" name="nama_alat" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCaraPakai" class="form-label">Cara Pakai</label>
                        <textarea class="form-control" id="formCaraPakai" name="cara_pakai" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formKelebihan" class="form-label">Kelebihan</label>
                        <textarea class="form-control" id="formKelebihan" name="kelebihan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formKekurangan" class="form-label">Kekurangan</label>
                        <textarea class="form-control" id="formKekurangan" name="kekurangan" required></textarea>
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
