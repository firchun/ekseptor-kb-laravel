@push('js')
    <script>
        $(function() {
            $('#datatable-customers').DataTable({
                processing: true,
                serverSide: false,
                responsive: false,
                ajax: '{{ url('ekseptor-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'kelurahan.nama_kelurahan',
                        name: 'kelurahan.nama_kelurahan'
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },

                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'no_bpjs',
                        name: 'no_bpjs'
                    },

                    {
                        data: 'jenis_ras',
                        name: 'jenis_ras'
                    },
                    {
                        data: 'action_pemantuan',
                        name: 'action_pemantuan'
                    }
                ],
                scrolX: true,
            });

            $('.refresh').click(function() {
                $('#datatable-customers').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/ekseptor/edit/' + id,
                    success: function(response) {
                        $('#idEkseptor').val(response.id);
                        // Tampilkan modal
                        $('#customersModal').modal('show');
                        if ($.fn.DataTable.isDataTable('#datatable-ekseptor-pemantauan')) {
                            $('#datatable-ekseptor-pemantauan').DataTable().destroy();
                        }

                        $('#btnTambahPemantauan').off('click').on('click', function() {
                            var formData = $('#tambahPemantauan').serialize();
                            $.ajax({
                                type: 'POST',
                                url: '/pemantauan-ekseptor/store',
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr('content')
                                },
                                success: function(response) {

                                    // Reload the DataTable after successfully saving data
                                    $('#datatable-ekseptor-pemantauan')
                                        .DataTable().ajax.reload();
                                },
                                error: function(xhr) {
                                    alert('Terjadi kesalahan: ' + xhr
                                        .responseText);
                                }
                            });
                        });
                        window.deleteData = function(id) {
                            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: '/pemantauan-ekseptor/delete/' + id,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    success: function(response) {
                                        // alert(response.message);
                                        $('#datatable-ekseptor-pemantauan')
                                            .DataTable().ajax
                                            .reload();
                                    },
                                    error: function(xhr) {
                                        alert('Terjadi kesalahan: ' + xhr
                                            .responseText);
                                    }
                                });
                            }
                        };

                        $('#datatable-ekseptor-pemantauan').DataTable({
                            processing: true,
                            serverSide: false,
                            responsive: false,
                            ajax: {
                                url: '/ekseptor-pemantauan-datatable/' + response.id,
                                type: 'GET'
                            },
                            columns: [{
                                    data: 'id',
                                    name: 'id'
                                },
                                {
                                    data: 'tanggal_penggunaan',
                                    name: 'tanggal_penggunaan'
                                },
                                {
                                    data: 'penggunaan',
                                    name: 'penggunaan'
                                },
                                {
                                    data: 'action',
                                    name: 'action'
                                }
                            ],
                            scrolX: true,
                        });

                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };



        });
    </script>
@endpush
