@extends('master.master')

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <form method="GET">
            <input value="{{ request()->query('search') }}" type="text" name="search">
            <button class="btn btn-outline-success">Procurar</button>
        </form>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                <th scope="col">Sector</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach($showUsers as $users)
              <tr>
                <th scope="row">{{ $users->id }}</th>
                <td>{{ $users->name }}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->type }}</td>
                <td>{{ $users->setor }}</td>
                <td><a href="{{ route('userContact.view', $users->id) }}" class="btn btn-outline-dark">Details</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>

@endsection
