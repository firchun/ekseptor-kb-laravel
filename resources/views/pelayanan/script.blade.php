@push('js')
    <script>
        $(function() {
            $('#datatable-customers').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('pelayanan-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },


                    {
                        data: 'komplikasi',
                        name: 'komplikasi'
                    },

                    {
                        data: 'kegagalan',
                        name: 'kegagalan'
                    },

                    {
                        data: 'dropout',
                        name: 'dropout'
                    },

                    {
                        data: 'pus_miskin',
                        name: 'pus_miskin'
                    },
                    {
                        data: 'pus_4t',
                        name: 'pus_4t'
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
                    url: '/pelayanan/edit/' + id,
                    success: function(response) {
                        $('#formCustomerId').val(response.id);
                        $('#formIdKelurahan').val(response.id_kelurahan);
                        $('#formKbAktif').val(response.kb_aktif);
                        $('#formKomplikasi').val(response.komplikasi);
                        $('#formKegagalan').val(response.kegagalan);
                        $('#formDropout').val(response.dropout);
                        $('#formPusMiskin').val(response.pus_miskin);
                        $('#formPus4T').val(response.pus_4t);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#userForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/pelayanan/store',
                    data: formData,
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
            $('#createCustomerBtn').click(function() {
                var formData = $('#createUserForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/pelayanan/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#customersModalLabel').text('Edit Customer');
                        $('#formCustomerName').val('');
                        $('#datatable-customers').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteCustomers = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/pelayanan/delete/' + id,
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
