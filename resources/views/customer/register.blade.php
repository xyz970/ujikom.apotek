@extends('layouts.authentication.master', ['title' => 'Daftar'])
@section('title', 'Daftar')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/vendors/select2.css') }}">
<link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('style')

@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-xl-7 p-0"><img class="bg-img-cover bg-center" src="../assets/images/login/1.jpg" alt="looginpage">
            </div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                                    src="../assets/images/logo.png" style="height: 100px; width: 100px;"
                                    alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{route('customer.signup_process')}}">
                                @csrf
                                <h4>Daftar</h4>
                                <p>Masukkan Data diri anda</p>

                                <div class="form-group">
                                    <label class="col-form-label">Nama</label>
                                    <input class="form-control" type="text" name="name" required="" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" required="" name="email" placeholder="Test@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">No Telepon</label>
                                    <input class="form-control" type="number" required="" name="phone" placeholder="08xxxxx">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="login[password]" required=""
                                            placeholder="*********">
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Kota</label>
                                    <div class="form-input position-relative">
                                        <select class="city form-control" data-menu="city" id="city"
                                            name="city_id"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Alamat</label>
                                    <textarea class="form-control" name="address" required></textarea>
                                </div>

                                <div class="form-group mb-0">
                                  
                                    <button class="btn btn-primary btn-block w-100" type="submit">Daftar</button>
                                </div>

                                <p class="mt-4 mb-0 text-center">Sudah punya akun?<a class="ms-2"
                                        href="{{ route('customer.login') }}">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#city').select2({
                theme: 'bootstrap-5',
                placeholder: "Pilih Kota",
                dropdownParent: $('.login-card'),
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
        });
    </script>
@endsection
