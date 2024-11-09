@extends('master.master')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">

                </div>
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center my-2"><img
                                src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                                width="150"></div>

                        <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
                        <form method="POST" action="{{ route('user.create') }}" class="needs-validation" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name">Name</label>
                                <input id="name" type="name" class="form-control" name="name" value=""
                                    autofocus="" fdprocessedid="8f7bri" required>
                                @error('name')
                                    <div>
                                        Name is invalid!
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value=""
                                    autofocus="" fdprocessedid="8f7bri" required>
                                @error('email')
                                    <div>
                                        Email is invalid!
                                    </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>

                                </div>
                                <input id="password" type="password" class="form-control" name="password" required=""
                                    fdprocessedid="2y22z">
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Photo</label>
                                <input class="form-control" type="file" id="formFile" name="foto">
                            </div>


                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">User Type</label>
                                </div>
                                <select class="form-select form-select-m" aria-label="Small select example" required
                                    name ="users_type_id">
                                    <option selected>-</option>
                                    @foreach ($sendUserType as $userType)
                                        <option value="{{ $userType->id }}">{{ $userType->type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Sector</label>
                                </div>
                                <select class="form-select form-select-m" aria-label="Small select example" name ="setor"
                                    required>
                                    <option selected>-</option>
                                    <option value="Tecnologia">Tecnologia</option>
                                    <option value="Comunicação Interpessoal">Comunicação Interpessoal</option>
                                    <option value="SQL">SQL</option>
                                    <option value="Android">Android</option>
                                    <option value="Laravel">Laravel</option>
                                </select>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto btnRegister" fdprocessedid="i5syyn">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            <a href="register.html" class="text-dark">Back to login</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-muted">
                    Copyright © 2024 — Cesae
                </div>
            </div>
        </div>
    </div>
@endsection
