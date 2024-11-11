@extends('master.master')

@section('content')
<div class="container h-100">
    <div class="row justify-content-sm-center h-100">
        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-7 col-sm-9">
            <div class="text-center my-5">

            </div>
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center my-2"><img src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo" width="150"></div>
<h1 class="fs-4 card-title fw-bold mb-4">Update</h1>

<form method="POST" action="{{ route('update.contact') }}" class="needs-validation" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="mb-2 text-muted" for="name" >Name</label>
        <input id="name" type="name" class="form-control" name="name" value="{{ $ourUser->name }}" autofocus="" fdprocessedid="8f7bri" required>
        @error('name')
            <div>
                Name is invalid!
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="mb-2 text-muted" for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ $ourUser->email }}" autofocus="" fdprocessedid="8f7bri" required>
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
        <input id="password" type="password" class="form-control" name="password" required="" fdprocessedid="2y22z">
        <div class="invalid-feedback">
            Password is required
        </div>
    </div>


    <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary ms-auto btnRegister" fdprocessedid="i5syyn">
            Update
        </button>
    </div>
    <input type="hidden" name="id" value="{{ $ourUser->id }}">
</form>
</div>
<div class="card-footer py-3 border-0">
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
