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
                        data: 'jumlah_anak',
                        name: 'jumlah_anak'
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
                        data: 'alat.nama_alat',
                        name: 'alat.nama_alat'
                    },
                    {
                        data: 'tanggal_pemakaian',
                        name: 'tanggal_pemakaian'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'jenis_ras',
                        name: 'jenis_ras'
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
                    url: '/ekseptor/edit/' + id,
                    success: function(response) {
                        $('#formEkeptorId').val(response.id);
                        $('#formAlatKontrasepsi').val(response.id_alat_kontrasepsi);
                        $('#formKelurahan').val(response.id_kelurahan);
                        $('#formNama').val(response.nama);
                        $('#formTanggalPemakaian').val(response.tanggal_pemakaian);
                        $('#formTanggalLahir').val(response.tanggal_lahir);
                        $('#formPendidikan').val(response.pendidikan);
                        $('#formAlamat').val(response.alamat);
                        $('#formJumlahAnak').val(response.jumlah_anak);
                        $('#formTinggiBadan').val(response.tinggi_badan);
                        $('#formBeratBadan').val(response.berat_badan);
                        $('#formNoBpjs').val(response.no_bpjs);
                        $('#formNik').val(response.nik);
                        $('#formJenisRas').val(response.jenis_ras);
                        // Tampilkan modal
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#ekseptorForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: '/ekseptor/store',
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
                var formData = $('#createEkseptorForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/ekseptor/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#formEkeptorId').val('');
                        $('#createFormAlatKontrasepsi').val('');
                        $('#createFormNama').val('');
                        $('#createFormTanggalPemakaian').val('');
                        $('#createFormTanggalLahir').val('');
                        $('#createFormPendidikan').val('');
                        $('#createFormAlamat').val('');
                        $('#createFormJumlahAnak').val('');
                        $('#createFormTinggiBadan').val('');
                        $('#createFormBeratBadan').val('');
                        $('#createFormNoBpjs').val('');
                        $('#createFormNik').val('');
                        $('#createFormJenisRas').val('');
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
                        url: '/ekseptor/delete/' + id,
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
