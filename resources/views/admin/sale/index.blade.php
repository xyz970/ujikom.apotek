@extends('layouts.simple.master', ['title' => 'Daftar Penjualan'])
@section('title', 'Daftar Penjualan')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Data Penjualan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Data Penjualan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Penjualan</h5>
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
                            <a class="btn btn-outline-success" href="{{route('admin.sale.export')}}">Export</a>
                        </div>
                        <div class="table table-responsive">
                            <table class="display" id="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Struk ID</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
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
                ajax: '{{ route('admin.sale.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'receipt_number',
                        name: 'receipt_number'
                    },
                    {
                        data: 'customer.name',
                        name: 'customer.name'
                    },
                    {
                        data: null,
                        name: 'total',
                        render: function(data, type, row) {
                            return row.total.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                        }
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: null,
                        name: 'pay_amount',
                        render: function(data, type, row) {
                            return row.pay_amount.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                        }
                    },
                    {
                        data: null,
                        name: 'back_amount',
                        render: function(data, type, row) {
                            return row.back_amount.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                        }
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
      function deleteData(id) {
            var deleteUrl = "{{ route('admin.sale.destroy', ':id') }}";
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
