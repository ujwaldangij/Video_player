@extends('admin.layout.login_and_register')
@section('title')
    login
@endsection
@section('data')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('asset/admin/img/emart-icon.png') }}" alt="">
                                    <span class="d-none d-lg-block">Emart Login</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Account</h5>
                                        <p class="text-center small">Enter username & password to login</p>
                                        @error('error')
                                            <div class="error text-danger fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <form class="row g-3" action="{{ route('post_login') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="Username" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="email">
                                            @error('email')
                                                <div class="error text-danger fw-bold">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="Password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="Password">
                                            @error('password')
                                                <div class="error text-danger fw-bold">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true"
                                                id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div> --}}
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="{{ route('get_register') }}">Create
                                                    an account</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
@endsection
