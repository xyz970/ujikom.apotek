@extends('layouts.authentication.master', ['title' => 'Login'])
@section('title', 'Login')

@section('css')
@endsection

@section('style')

@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                                    src="../assets/images/logo.png" style="height: 100px; width: 100px;" alt="looginpage"></a></div>
                        <div class="login-main">
                            @if (Session::has('successRegister'))
                            <div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Berhasil mendaftar </strong> Anda bisa masuk dengan akun yang telah anda buat.
                               
                              </div>
                            @endif
                            <form class="theme-form" method="POST" action="{{route('customer.login_process')}}">
                                {{ csrf_field() }}
                                <h4>Login</h4>
                                <p>Masukkan username & password anda</p>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Mohon cek kembali username dan password anda
                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required=""
                                        placeholder="Test@xxxx.">

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="login[password]" required=""
                                            placeholder="*********">
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                                <p class="mt-4 mb-0 text-center">Tidak punya akun?<a class="ms-2" href="{{route('customer.signup')}}">Buat Akun</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
