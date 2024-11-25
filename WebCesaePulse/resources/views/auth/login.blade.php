@extends('master.master')
@section('content')
    <div class="container h-100">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif


        <div class="row justify-content-sm-center h-100 mt-5">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 mt-5">
                <div class="text-center my-5">


                </div>
                <div class="card shadow-lg ">
                    <div class="card-body p-5">
                        <div class="text-center my-2"><img
                                src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                                width="150"></div>

                        <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate=""
                            autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">Email</label>
                                <input id="email" type="email"
                                    class="form-control" name="email" value=""
                                    required="" autofocus="" fdprocessedid="8f7bri">

                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>

                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                    <a href="forgot.html" class="float-end">
                                        Esqueceste-te da password?
                                    </a>
                                </div>
                                <input id="password" type="password"
                                    class="form-control" name="password"
                                    required="" fdprocessedid="2y22z">

                                    <div class="invalid-feedback">
                                        Esqueceste-te da password?
                                    </div>

                            </div>

                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                    <label for="remember" class="form-check-label">Lembrar-me</label>
                                </div>
                                <button type="submit" class="btn btn-primary ms-auto" fdprocessedid="i5syyn">
                                    Entrar
                                </button>
                            </div>
                        </form>
                    </div>



                    @auth
                        @if (Auth::user()->user_type_id == 1)
                            <div class="card-footer py-3 border-0">
                                <div class="text-center">
                                    Add a new user? <a href={{ route('register.get') }} class="text-dark">Register here</a>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
    </div>
    @if ($errors->any())
                    <div class="container alert alert-danger text-center mt-4 w-50">
                        {{ str_replace('These credentials do not match our records.', 'As credenciais que introduziu estão incorretas.', $errors->first()) }}
                    </div>
                    @endif
    <div class="empurra_footer">

    </div>
@endsection
