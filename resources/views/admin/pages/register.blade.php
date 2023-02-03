@extends('admin.layout.login_and_register')
@section('title')Register User
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
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter personal details to create account</p>
                                    @error('error')
                                    <div class="error text-danger fw-bold">{{ $message }}</div>
                                    @enderror
                                </div>

                                <form class="row g-3" action="{{ route('post_register') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="Name" class="form-label"> Name</label>
                                        <input type="text" name="name" class="form-control" id="Name"
                                            value="{{ old("name") }}">
                                        @error('name')
                                        <div class="error text-danger fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="Email" class="form-label"> Email</label>
                                        <input type="email" name="email" class="form-control" id="Email"
                                            value="{{ old("email") }}">
                                        @error('email')
                                        <div class="error text-danger fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="Username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="Username"
                                            value="{{ old("username") }}">
                                        @error('username')
                                        <div class="error text-danger fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="Role" class="form-label">Role</label>
                                        <select class="form-select" aria-label="Default select example" name="role">
                                            <option value="1">Normal User</option>
                                            <option value="2">Admin User</option>
                                            <option value="3">Super Admin User</option>
                                        </select>
                                        @error('role')
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

                                    <div class="col-12">
                                        <label for="Password" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="Password">
                                        @error('password_confirmation')
                                        <div class="error text-danger fw-bold">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a
                                                href="{{ route('get_login') }}">Log
                                                in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Designed by <a href="">Uts Creation</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
@endsection
