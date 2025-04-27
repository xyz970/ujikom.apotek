@extends('layouts.simple.master', ['title' => 'Daftar Administrator'])
@section('title', 'Daftar Administrator')

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
    <h3>Data Administrator</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Data Administrator</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Administrator</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 col-4">
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="tambahAdministrator"
                                id="tambahAdministrator" tabindex="-1" role="dialog" aria-labelledby="tambahAdministrator"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Administrator</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.administrator_user.store') }}">
                                                {{ csrf_field() }}
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Nama</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Username</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="username">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Role</label>
                                                    <div class="col-sm-9">
                                                        <select class="custom-select form-select" name="role">
                                                            <option selected="">---- PILIH ---</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="apoteker">Apoteker</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted" id="emailHelp">* Password bawaan adalah
                                                    12345 diharapkan anda mengganti password anda setelah membuat
                                                    akun.</small>

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
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="editAdministrator"
                                id="editAdministrator" tabindex="-1" role="dialog" aria-labelledby="editAdministrator"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" id="editForm">
                                                @method("PUT")
                                                {{ csrf_field() }}
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Nama</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="name" id="edit_name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Username</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="username" id="edit_username">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Password</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text"
                                                            name="password" id="edit_username">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Role</label>
                                                    <div class="col-sm-9">
                                                        <select class="custom-select form-select" name="role" id="edit_role">
                                                            <option selected="">---- PILIH ---</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="apoteker">Apoteker</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted" id="emailHelp">* Kosongi kolom password jika tidak ingin mengubah password</small>
                                               

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" data-type="btn-ubahmeja"
                                                type="submit">Ubah</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-outline-primary" data-btn="showModal" data-bs-toggle="modal"
                                data-bs-target="#tambahAdministrator">Tambah Administrator</button>
                        </div>
                        <div class="table table-hover table-responsive">
                            <table class="display" id="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
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
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.administrator_user.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },

                    {
                        data: 'role',
                        name: 'role',
                        render: function(data, type, row) {
                            if (row.role == "admin") {
                                return `<span class="badge rounded-pill badge-primary">Admin</span>`;
                            } else {
                                return `<span class="badge rounded-pill badge-success">Apoteker</span>`;
                            }
                        }
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        render: function(data, type, row) {
                            if (row.role == "admin") {
                                return `-`;
                            } else {
                                return `
                       
                        <form id="deleteForm">
                            @method('DELETE')
                            @csrf
                             <button class="btn btn-primary btn-action mr-1" type="button" data-toggle="tooltip" title="Edit"
                            onclick="edit('${row.id}')">
                            <i class="fas fa-pencil-alt"></i>
                        </button> |  
                             <button class="btn btn-danger btn-action mr-1" data-toggle="tooltip" onclick="deleteData('${row.id}');" id="deleteBtn" title="delete"
                            type="button">
                            <i class="fas fa-trash"></i>
                        </button>
                        </form>`;
                            }
                        }
                    }
                ]
            });
        });

        function edit(id) {
            var url = "{{ route('admin.administrator_user.edit', ':id') }}"
            var updateUrl = "{{ route('admin.administrator_user.update', ':id') }}"
            $.ajax({
                url: url.replace(':id', id),
                success: function(res) {
                    $('#editForm').attr('action', updateUrl.replace(':id', id));
                    $('#edit_name').val(res.data.name);
                    $('#edit_username').val(res.data.username);
                    $('#edit_role').val(res.data.role).change();
                    $('#editAdministrator').modal('show');
                    
                },
                dataType: 'json',
            });
        }

        function deleteData(id) {
            var deleteUrl = "{{ route('admin.administrator_user.destroy', ':id') }}";
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
