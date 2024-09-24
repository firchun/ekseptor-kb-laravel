@push('js')
    <script>
        $(function() {
            $('#datatable-customers').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('alat-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'foto',
                        name: 'foto'
                    },
                    {
                        data: 'kode_alat',
                        name: 'kode_alat'
                    },
                    {
                        data: 'nama_alat',
                        name: 'nama_alat'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                scrolX: true,
            });
            $('.create-new').click(function() {
                $('#create').modal('show');
            });
            $('.refresh').click(function() {
                $('#datatable-customers').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/alat/edit/' + id,
                    success: function(response) {
                        $('#formCustomerId').val(response.id);
                        $('#formKodeAlat').val(response.kode_alat);
                        $('#formNamaAlat').val(response.nama_alat);
                        $('#formCaraPakai').val(response.cara_pakai);
                        $('#formKelebihan').val(response.kelebihan);
                        $('#formKekurangan').val(response.kekurangan);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                let form = $('#userForm')[0];
                let formData = new FormData(form); // Use FormData for file uploads

                $.ajax({
                    type: 'POST',
                    url: '/alat/store',
                    data: formData,
                    processData: false, // Prevent jQuery from automatically converting the data
                    contentType: false, // Prevent jQuery from setting contentType header
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-customers').DataTable().ajax.reload();
                        $('#customersModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });

            // Handle form submission for creating new records
            $('#createCustomerBtn').click(function() {
                let form = $('#createUserForm')[0];
                let formData = new FormData(form); // Use FormData for file uploads

                $.ajax({
                    type: 'POST',
                    url: '/alat/store',
                    data: formData,
                    processData: false, // Prevent jQuery from automatically converting the data
                    contentType: false, // Prevent jQuery from setting contentType header
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#createUserForm')[0].reset(); // Reset form fields
                        $('#datatable-customers').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteCustomers = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/alat/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-customers').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
        });
    </script>
@endpush
