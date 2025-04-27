@extends('layouts.simple.master', ['title' => 'Daftar Pelanggan'])
@section('title', 'Daftar Pelanggan')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('style')
    <style>
        .select2-result__option {
            background-color: white;
            color: blue;
        }

        .select2-dropdown .select2-dropdown--below {
            background-color: white !important;
            color: blue;
        }

        .select2-dropdown--below {
            background-color: white !important;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Data Pelanggan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Data Pelanggan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Pelanggan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 col-4">
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="tambahCustomer"
                                id="tambahCustomer" tabindex="-1" role="dialog" aria-labelledby="tambahCustomer"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.customer.store') }}">
                                                {{ csrf_field() }}
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Nama
                                                        Pelanggan</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">No
                                                        Telepon</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="phone">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="no_hp">Kota
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select class="city form-select" data-menu="city" id="city"
                                                            name="city_id"></select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" type="text" required name="address"></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" data-type="btn-ubahmeja"
                                                type="submit">Tambah</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="editSupplier"
                                id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="editSupplier"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Supplier</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" id="updateSupplierForm">
                                                {{ csrf_field() }}
                                                @method('PUT')
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Nama
                                                        Supplier</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            id="edit_name" name="name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">No
                                                        Telepon</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            id="edit_phone" name="phone">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="no_hp">Kota
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select class="city form-select" data-menu="city"
                                                            id="city_update" name="city_id"></select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" id="edit_address" type="text" required name="address"></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" data-type="btn-ubahmeja"
                                                type="submit">Tambah</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-outline-primary" data-btn="showModal" data-bs-toggle="modal"
                                data-bs-target="#tambahCustomer">Tambah Pelanggan</button>
                        </div>
                        <div class="table table-hover table-responsive">
                            <table class="display" id="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No Telepon</th>
                                        <th>Kota</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/touchspin/touchspin.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    @include('layouts.simple.alert')
    <script>
        $(document).ready(function() {
            $('#city').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Kota",
                dropdownParent: $('#tambahCustomer'),
                ajax: {
                    url: "{{ route('admin.city.index') }}",
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });

            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.customer.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'city.name',
                        name: 'city.name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        render: function(data, type, row) {
                            return `
                       
                        <form id="deleteForm">
                            @method('DELETE')
                            @csrf
                             
                             <button class="btn btn-danger btn-action mr-1" data-toggle="tooltip" onclick="deleteData('${row.id}');" id="deleteBtn" title="delete"
                            type="button">
                            <i class="fas fa-trash"></i>
                        </button>
                        </form>`;
                        }
                    }
                ]
            });
        });

        function edit(id) {
            var url = "{{ route('admin.customer.edit', ':id') }}"
            var updateUrl = "{{ route('admin.customer.update', ':id') }}"
            $.ajax({
                url: url.replace(':id', id),
                success: function(res) {
                    $('#updateSupplierForm').attr('action', updateUrl.replace(':id', id));
                    $('#edit_name').val(res.data.name);
                    $('#edit_address').val(res.data.address);
                    $('#edit_phone').val(res.data.phone);
                    $('#editSupplier').modal('show');
                    $('#city_update').select2({
                        theme: 'bootstrap-5',
                        placeholder: res.data.city.name,
                        dropdownParent: $('#editSupplier'),
                        ajax: {
                            url: "{{ route('admin.city.index') }}",
                            dataType: 'json',
                            delay: 250,
                            type: 'GET',
                            processResults: function(data) {
                                return {
                                    results: $.map(data.data, function(item) {
                                        return {
                                            text: item.name,
                                            id: item.id
                                        }
                                    })
                                };
                            },
                            cache: true
                        },
                        minimumInputLength: 1
                    });
                },
                dataType: 'json',
            });
        }

        function deleteData(id) {
            var deleteUrl =  "{{ route('admin.customer.destroy', ':id') }}";
            swal({
                title: "Anda Yakin?",
                text: "Apakah anda yakin untuk menghapus data ini?",
                icon: "warning",
                buttons: ['Batal', 'OK'],
                dangerMode: true
            }).then((willDelete) => {
                 if (willDelete) {
                    $('#deleteForm').attr('action', deleteUrl.replace(':id', id));
                    $('#deleteForm').attr('method', "POST");
                    $('#deleteForm').submit();
                }
            });
        }
    </script>
@endsection
