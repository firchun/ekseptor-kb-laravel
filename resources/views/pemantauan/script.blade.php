@push('js')
    <script>
        $(function() {
            $('#datatable-customers').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('pemantauan-datatable') }}',
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart +
                                1;
                        },
                        name: 'id',
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'text-center'
                    },
                    {
                        data: 'kelurahan.nama_kelurahan',
                        name: 'kelurahan.nama_kelurahan',
                        className: 'text-center'
                    },
                    {
                        data: 'terima_pil',
                        name: 'terima_pil',
                        className: 'text-center'
                    },

                    {
                        data: 'terima_suntik',
                        name: 'terima_suntik',
                        className: 'text-center'
                    },
                    {
                        data: 'terima_akdr',
                        name: 'terima_akdr',
                        className: 'text-center'
                    },
                    {
                        data: 'terima_impln',
                        name: 'terima_impln',
                        className: 'text-center'
                    },
                    {
                        data: 'terima_kdm',
                        name: 'terima_kdm',
                        className: 'text-center'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center'
                    },

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
                    url: '/pemantauan/edit/' + id,
                    success: function(response) {
                        $('#formCustomerId').val(response.id);
                        $('#tanggal').val(response.tanggal);
                        $('#terima_pil').val(response.terima_pil);
                        $('#terima_suntik').val(response.terima_suntik);
                        $('#terima_akdr').val(response.terima_akdr);
                        $('#terima_impln').val(response.terima_impln);
                        $('#terima_kdm').val(response.terima_kdm);
                        $('#id_kelurahan').val(response.id_kelurahan);
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
                    url: '/pemantauan/store',
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
                    url: '/pemantauan/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
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
                        url: '/pemantauan/delete/' + id,
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
