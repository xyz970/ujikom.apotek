@extends('layouts.simple.master', ['title' => 'Daftar Tipe Obat'])
@section('title', 'Daftar Tipe Obat')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Data Tipe Obat</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Data Tipe Obat</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Tipe Obat</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 col-4">
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="tambahTipeObat"
                                id="tambahTipeObat" tabindex="-1" role="dialog" aria-labelledby="tambahTipeObat"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Obat</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.medicine_form_type.store') }}">
                                                {{ csrf_field() }}
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Tipe
                                                        Obat</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="type">
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
                                data-bs-target="#tambahTipeObat">Tambah Tipe Obat</button>
                        </div>
                        <div class="table table-responsive">
                            <table class="display" id="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipe Obat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($medicine_type as $item)
                                        <div class="modal fade bd-example-modal-lg modal-detail"
                                            data-modal="editTipeObat{{ $item->id }}"
                                            id="editTipeObat{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="editTipeObat{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" style="background-color: white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Tipe Obat</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close" data-bs-original-title=""
                                                        title=""></button>
                                                </div>
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <form method="POST"
                                                            action="{{ route('admin.medicine_form_type.update', $item->id) }}">
                                                            {{ csrf_field() }}
                                                            @method('PUT')
                                                            <div class="mb-3 row">
                                                                <label class="col-sm-3 col-form-label f-w-600"
                                                                    for="meja">Tipe
                                                                    Obat</label>
                                                                <div class="col-sm-9">
                                                                    <input class="meja form-control" type="text" required
                                                                        value="{{ $item->type }}" name="type">
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
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <form id="deleteForm{{ $item->id }}" onsubmit=''>
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" class="btn btn-primary btn-action mr-1"
                                                        data-toggle="tooltip" title="Edit" data-btn="showModal"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editTipeObat{{ $item->id }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button> |
                                                    <button class="btn btn-danger btn-action mr-1" data-toggle="tooltip"
                                                        onclick="deleteData('{{ $item->id }}');" id="deleteBtn"
                                                        title="delete" type="button">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
            $('#data-table').DataTable();
        });

        function edit(id) {
            var url = "{{ route('admin.supplier.edit', ':id') }}"
            var updateUrl = "{{ route('admin.supplier.update', ':id') }}"
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
            var deleteUrl = "{{ route('admin.medicine_form_type.destroy', ':id') }}";
            swal({
                title: "Anda Yakin?",
                text: "Apakah anda yakin untuk menghapus data ini?",
                icon: "warning",
                buttons: ['Batal', 'OK'],
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    $('#deleteForm' + id).attr('action', deleteUrl.replace(':id', id));
                    $('#deleteForm' + id).attr('method', "POST");
                    $('#deleteForm' + id).submit();
                }
            });
        }
    </script>
@endsection
