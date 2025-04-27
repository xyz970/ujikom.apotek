@extends('layouts.simple.master', ['title' => 'Daftar Obat'])
@section('title', 'Daftar Obat')

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
    <h3>Data Obat</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Data Obat</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Obat</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 col-4">
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="tambahObat" id="tambahObat"
                                tabindex="-1" role="dialog" aria-labelledby="tambahObat" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.medicine.store') }}">
                                                {{ csrf_field() }}
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Nama
                                                        Obat</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" required
                                                            name="name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="no_hp">Tipe Obat
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select class="medicine_form_type_id form-select"
                                                            id="medicine_form_type" name="medicine_form_type_id"></select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="no_hp">Supplier</label>
                                                    <div class="col-sm-9">
                                                        <select class="supplier form-select" data-menu="supplier"
                                                            id="supplier" name="supplier_id"></select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Tanggal
                                                        Kadaluarsa
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" id="exp_date" type="date"
                                                            required name="exp_date">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Harga
                                                        Beli</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="number" required
                                                            name="buy_price">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Harga
                                                        Jual</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="number" required
                                                            name="sell_price">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Stok</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="number" required
                                                            name="stock">
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
                            <div class="modal fade bd-example-modal-lg modal-detail" data-modal="editObat" id="editObat"
                                tabindex="-1" role="dialog" aria-labelledby="editObat" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="background-color: white">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                            aria-label="Close" data-bs-original-title="" title=""></button>
                                    </div>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form method="POST" id="updateForm">
                                                {{ csrf_field() }}
                                                @method('PUT')
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Nama
                                                        Obat</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" type="text" id="edit_name"
                                                            required name="name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="no_hp">Tipe
                                                        Obat
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select class="medicine_form_type_id form-select"
                                                            id="edit_medicine_form_type_id"
                                                            name="medicine_form_type_id"></select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="no_hp">Supplier</label>
                                                    <div class="col-sm-9">
                                                        <select class="supplier form-select" data-menu="supplier"
                                                            id="edit_supplier" name="supplier_id"></select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Tanggal
                                                        Kadaluarsa
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" id="edit_exp_date"
                                                            type="date" required name="exp_date">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Harga
                                                        Beli</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" id="edit_buy_price"
                                                            type="number" required name="buy_price">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600" for="meja">Harga
                                                        Jual</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" id="edit_sell_price"
                                                            type="number" required name="sell_price">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label f-w-600"
                                                        for="meja">Stok</label>
                                                    <div class="col-sm-9">
                                                        <input class="meja form-control" id="edit_stock" type="number"
                                                            required name="stock">
                                                    </div>
                                                </div>
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
                                data-bs-target="#tambahObat">Tambah Obat</button>
                        </div>
                        <div class="table table-hover table-responsive">
                            <table class="display" id="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis Obat</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Tanggal Kadaluarsa</th>
                                        <th>Stok</th>
                                        <th>Supplier</th>
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
            $('#supplier').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Supplier",
                dropdownParent: $('#tambahObat'),
                ajax: {
                    url: "{{ route('admin.supplier.data') }}",
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

            $('#medicine_form_type').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Tipe",
                dropdownParent: $('#tambahObat'),
                ajax: {
                    url: "{{ route('admin.medicine_form_type.data') }}",
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.type,
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
                ajax: '{{ route('admin.medicine.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'medicine_form_type.type',
                        name: 'medicine_form_type.type'
                    },

                    {
                        data: null,
                        name: 'buy_price',
                        render: function(data, type, row) {
                            return row.buy_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                        }
                    },
                    {
                        data: null,
                        name: 'sell_price',
                        render: function(data, type, row) {
                            return row.sell_price.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                        }
                    },
                    {
                        data: 'exp_date',
                        name: 'exp_date',
                        render: function(data, type, row) {
                            var date1 = new Date(row.exp_date)
                            var date2 = new Date()
                            const deviation = getDateDeviation(date1, date2);
                            if (deviation.days < 30) {
                                return `<span data-toggle="tooltip" title="Obat akan Kadaluarsa kurang dari ${deviation.days} hari lagi" class="badge rounded-pill badge-danger">${row.exp_date}</span>`;
                            } else {
                                return `<span class="badge rounded-pill badge-success">${row.exp_date}</span>`;
                            }
                        }
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },

                    {
                        data: 'supplier.name',
                        name: 'supplier.name'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        render: function(data, type, row) {
                            return `
                       
                        <form id="deleteForm">
                            @method('DELETE')
                            @csrf
                             <button type="button" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"
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
                ]
            });
        });

        function getDateDeviation(date1, date2) {
            const timeDifference = Math.abs(date2.getTime() - date1.getTime());
            const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));
            const hoursDifference = Math.ceil(timeDifference / (1000 * 3600));
            const minutesDifference = Math.ceil(timeDifference / (1000 * 60));
            const secondsDifference = Math.ceil(timeDifference / 1000);

            return {
                days: daysDifference,
                hours: hoursDifference,
                minutes: minutesDifference,
                seconds: secondsDifference,
            };
        }

        function edit(id) {
            var url = "{{ route('admin.medicine.edit', ':id') }}"
            var updateUrl = "{{ route('admin.medicine.update', ':id') }}"
            $.ajax({
                url: url.replace(':id', id),
                success: function(res) {
                    $('#updateForm').attr('action', updateUrl.replace(':id', id));
                    $('#edit_name').val(res.data.name);
                    $('#edit_buy_price').val(res.data.buy_price);
                    $('#edit_sell_price').val(res.data.sell_price);
                    $('#edit_exp_date').val(res.data.exp_date);
                    $('#edit_stock').val(res.data.stock);
                    $('#editObat').modal('show');
                    $('#edit_supplier').select2({
                        theme: 'bootstrap-5',
                        placeholder: res.data.supplier.name,
                        dropdownParent: $('#editObat'),
                        ajax: {
                            url: "{{ route('admin.supplier.data') }}",
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

                    $('#edit_medicine_form_type_id').select2({
                        theme: 'bootstrap-5',
                        placeholder: res.data.medicine_form_type.type,
                        dropdownParent: $('#editObat'),
                        ajax: {
                            url: "{{ route('admin.medicine_form_type.data') }}",
                            dataType: 'json',
                            delay: 250,
                            type: 'GET',
                            processResults: function(data) {
                                return {
                                    results: $.map(data.data, function(item) {
                                        return {
                                            text: item.type,
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
            var deleteUrl = "{{ route('admin.medicine.destroy', ':id') }}";
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
