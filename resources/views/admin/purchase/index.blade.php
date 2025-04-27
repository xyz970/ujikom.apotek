@extends('layouts.simple.master', ['title' => 'Daftar Pembelian'])
@section('title', 'Daftar Pembelian')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Data Pembelian</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item active">Data Pembelian</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 col-4">
                          
                            <a class="btn btn-outline-primary" href="{{route('admin.purchase.create')}}">Tambah Pembelian</a>
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
                ajax: '{{ route('admin.purchase.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'receipt_number',
                        name: 'receipt_number'
                    },
                    {
                        data: 'supplier.name',
                        name: 'supplier.name'
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
                        name: 'total',
                        render: function(data, type, row) {
                            return row.total.toLocaleString('id-ID', {
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
            var deleteUrl = "{{ route('admin.purchase.destroy', ':id') }}";
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
