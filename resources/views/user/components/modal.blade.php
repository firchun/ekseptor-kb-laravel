<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="text" id="formCustomerId" name="id">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" id="formCustomerName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control" id="formCustomerLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Email</label>
                        <input type="email" class="form-control" id="formCustomerEmail" name="email" required>
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
                <h5 class="modal-title" id="userModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control" id="formCustomerName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control" id="formCustomerName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Email</label>
                        <input type="email" class="form-control" id="formCustomerName" name="email" required>
                    </div>
                    @if ($role != 'Admin')
                        <div class="mb-3">
                            <label for="formCustomerName" class="form-label">Puskesmas</label>
                            <select class="form-control" name="id_puskesmas">
                                @foreach (App\Models\Puskesmas::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_puskesmas }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Password</label>
                        <input type="password" class="form-control" id="formCustomerName" name="password" required>
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
