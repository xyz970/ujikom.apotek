@extends('layouts.simple.master', ['title' => 'Tambah Pembelian'])
@section('title', 'Tambah Pembelian')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Tambah Pembelian</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Master</li>
    <li class="breadcrumb-item">Pembelian</li>
    <li class="breadcrumb-item active">Tambah Pembelian</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="inputEmail3">Pilih Obat</label>
                                <div class="col-sm-9">
                                    <select class="medicine form-select" id="medicine" name="medicine"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="inputEmail3">Pilih Supplier</label>
                                <div class="col-sm-9">
                                    <select class="supplier form-select" id="supplier" name="supplier"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="order-history table-responsive wishlist">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Prdouct Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <div class="input-group">

                                                </div>
                                            </td>
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end"><span class="f-w-600">Grand Total :</span></h6>
                                            </td>
                                            <td><span id="grandTotal">0 </span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="input-group">

                                                </div>
                                            </td>
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end"><span class="f-w-600">Kembalian :</span></h6>
                                            </td>
                                            <td><span id="back_amount"> </span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="input-group">

                                                </div>
                                            </td>
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end"><span class="f-w-600">Bayar :</span></h6>
                                            </td>
                                            <td> <input class="meja form-control" id="pay_amount" type="number"
                                                    required name="pay_amount"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">

                                            </td>
                                            <td> <button class="btn btn-outline-primary" id="bayar">Bayar</button></td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
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
    <script src="{{ asset('assets/js/touchspin/input-groups.min.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/touchspin/vendors.js') }}"></script> --}}
    @include('layouts.simple.alert')
    <script>
        var selectedItem = [];
        var choiceSelected = {};
        $(document).ready(function() {

            $('#medicine').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Obat",
                dropdownParent: $('.card-body'),
                ajax: {
                    url: "{{ route('admin.medicine.data') }}",
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    processResults: function(data) {
                        choiceSelected = data.data;
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
            $('#supplier').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Supplier",
                dropdownParent: $('.card-body'),
                ajax: {
                    url: "{{ route('admin.supplier.data') }}",
                    dataType: 'json',
                    delay: 250,
                    type: 'GET',
                    processResults: function(data) {
                        choiceSelected = data.data;
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

            $('#medicine').on('select2:select', function(e) {
                const selectedItem = e.params.data;
                addSelectedItem(choiceSelected[0]);
                // Bersihkan pemilihan setelah menambahkan
                $(this).val(null).trigger('change');
                $('#medicine').select2('open');

            });

            function addSelectedItem(item) {
                const checkIfExist = obj => obj.name === item.name;
                if (selectedItem.some(checkIfExist)) {
                    const index = selectedItem.findIndex(item => item.name === item.name);
                    var existData = selectedItem[index];
                    var data = {
                        'id': item.id,
                        'name': item.name,
                        'sell_price': item.sell_price,
                        'qty': existData.qty + 1,
                        'total': (existData.qty + 1) * item.sell_price
                    };
                    selectedItem[index] = data;
                    console.log(existData.qty);
                    updateItem()
                } else {
                    var data = {
                        'id': item.id,
                        'name': item.name,
                        'sell_price': item.sell_price,
                        'qty': 1,
                        'total': item.sell_price
                    };
                    selectedItem.push(data)
                    appendToList(item)
                }

                console.log(selectedItem);
            }

            // function formatRupiah(number) {
            //     return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            // }

            function appendToList(item) {
                grandTotal()
                const index = selectedItem.findIndex(item => item.name === item.name);
                var existData = selectedItem[index];
                var html = `
                <tr>
                    <td>
                                                <div class="product-name"><a href="#">${item.name}</a></div>
                                            </td>
                                            <td>${item.sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                            
                                            <td>
                                                <fieldset class="qty-box">
                                                   <div class="input-group bootstrap-touchspin">
                                    <button onclick="minusQty('${item.id}','${index}')" class="btn btn-primary btn-square bootstrap-touchspin-down" type="button"><i class="fa fa-minus"></i>
                                        </button><span class="input-group-text bootstrap-touchspin-prefix" style="display: none;"></span>
                                        <input class="touchspin text-center form-control" type="text" id="inputQty${item.id}" value="1" style="display: block;">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button onclick="addQty('${item.id}','${index}')" class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button>
                                  </div>
                                                </fieldset>
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Edit"
                                                onclick="deleteQty('${index}')">
                                                <i class="fas fa-xmark"></i>
                                            </button></td>
                                            <td>${item.sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                        </tr>
                `
                $('#cart').append(html)
            }

            function updateItem() {
                grandTotal()
                $('#cart').empty();
                for (let index = 0; index < selectedItem.length; index++) {
                    console.log(selectedItem[index]);
                    $('#cart').append(`
                                        <tr>
                                            <td>
                                                <div class="product-name"><a href="#">${selectedItem[index].name}</a></div>
                                            </td>
                                            <td>${selectedItem[index].sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                            
                                            <td>
                                                <fieldset class="qty-box">
                                                   <div class="input-group bootstrap-touchspin">
                                    <button onclick="minusQty('${selectedItem[index].id}','${selectedItem[index]}')" class="btn btn-primary btn-square bootstrap-touchspin-down" type="button"><i class="fa fa-minus"></i>
                                        </button><span class="input-group-text bootstrap-touchspin-prefix" style="display: none;"></span>
                                        <input class="touchspin text-center form-control" type="text" id="inputQty${selectedItem[index].id}" value="${selectedItem[index].qty}" style="display: block;">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button onclick="addQty('${selectedItem[index].id}','${selectedItem[index]}')" class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button>
                                  </div>
                                                </fieldset>
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Edit"
                                                onclick="deleteQty('${index}')">
                                                <i class="fas fa-xmark"></i>
                                            </button></td>
                                            <td>${selectedItem[index].total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                        </tr>
                `)

                }

            }

            $('#pay_amount').on('input',function(){
                var back_amount = parseInt($('#pay_amount').val()) - parseInt($('#grandTotal').text())
                console.log(back_amount);
                $('#back_amount').text(back_amount);
            });
        })

        function minusQty(element, index) {
            var inputVal = $('#inputQty' + element).val()
            var total = parseInt(inputVal) - 1
            $('#inputQty' + element).val(total);
            var existData = selectedItem[index];

            var data = {
                'id': existData.id,
                'name': existData.name,
                'sell_price': existData.sell_price,
                'qty': existData.qty - 1,
                'total': (existData.qty - 1) * existData.sell_price
            };
            selectedItem[index] = data;
            $('#cart').empty()
            grandTotal()
            for (let index = 0; index < selectedItem.length; index++) {
                console.log(selectedItem[index]);
                $('#cart').append(`
                                        <tr>
                                            <td>
                                                <div class="product-name"><a href="#">${selectedItem[index].name}</a></div>
                                            </td>
                                            <td>${selectedItem[index].sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                            
                                            <td>
                                                <fieldset class="qty-box">
                                                   <div class="input-group bootstrap-touchspin">
                                    <button onclick="minusQty('${selectedItem[index].id}','${index}')" class="btn btn-primary btn-square bootstrap-touchspin-down" type="button"><i class="fa fa-minus"></i>
                                        </button><span class="input-group-text bootstrap-touchspin-prefix" style="display: none;"></span>
                                        <input class="touchspin text-center form-control" type="text" id="inputQty${selectedItem[index].id}" value="${selectedItem[index].qty}" style="display: block;">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button onclick="addQty('${selectedItem[index].id}','${index}')" class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button>
                                  </div>
                                                </fieldset>
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Edit"
                                                onclick="deleteQty('${index}')">
                                                <i class="fas fa-xmark"></i>
                                            </button></td>
                                            <td>${selectedItem[index].total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                        </tr>
                `)

            }

        }

        function addQty(element, index) {
            var inputVal = $('#inputQty' + element).val()
            var total = parseInt(inputVal) + 1;
            $('#inputQty' + element).val(total);
            var existData = selectedItem[index];
            var data = {
                'id': existData.id,
                'name': existData.name,
                'sell_price': existData.sell_price,
                'qty': existData.qty + 1,
                'total': (existData.qty + 1) * existData.sell_price
            };
            console.log(existData);
            selectedItem[index] = data;
            $('#cart').empty()
            grandTotal()
            for (let index = 0; index < selectedItem.length; index++) {
                console.log(selectedItem[index]);
                $('#cart').append(`
                                        <tr>
                                            <td>
                                                <div class="product-name"><a href="#">${selectedItem[index].name}</a></div>
                                            </td>
                                            <td>${selectedItem[index].sell_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                            
                                            <td>
                                                <fieldset class="qty-box">
                                                   <div class="input-group bootstrap-touchspin">
                                    <button onclick="minusQty('${selectedItem[index].id}','${index}')" class="btn btn-primary btn-square bootstrap-touchspin-down" type="button"><i class="fa fa-minus"></i>
                                        </button><span class="input-group-text bootstrap-touchspin-prefix" style="display: none;"></span>
                                        <input class="touchspin text-center form-control" type="text" id="inputQty${selectedItem[index].id}" value="${selectedItem[index].qty}" style="display: block;">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button onclick="addQty('${selectedItem[index].id}','${index}')" class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button>
                                  </div>
                                                </fieldset>
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Edit"
                                                onclick="deleteQty('${index}')">
                                                <i class="fas fa-xmark"></i>
                                            </button></td>
                                            <td>${selectedItem[index].total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</td>
                                        </tr>
                `)

            }

        }

        function deleteQty(index) {
            $('#cart').empty()
            delete selectedItem[index];
        }

        function grandTotal() {
            $('#grandTotal').text(0)
            var sum = 0;
            for (let index = 0; index < selectedItem.length; index++) {
                sum += parseInt(selectedItem[index].total)
            }
            console.log(sum);
            $('#grandTotal').text(sum)

        }

       

        $('#bayar').click(function() {
            var data = {
                "_token": "{{ csrf_token() }}",
                supplier_id: $('#supplier').val(),
                pay_amount: $('#pay_amount').val(),
                total: parseInt($('#grandTotal').text()),
                back_amount: $('#back_amount').text(),
                medicine_items: selectedItem.map(item => ({
                    id: item.id,
                    qty: item.qty,
                    grand_total: item.total,
                })),
            }
            $.ajax({
                url: "{{ route('admin.purchase.store') }}",
                type: 'POST',
                data: data,
                success: function(response) {
                    swal("Success", "Data berhasil didata", "success");
                    location.reload();

                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan pada server';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                }
            });
        })
    </script>
@endsection
