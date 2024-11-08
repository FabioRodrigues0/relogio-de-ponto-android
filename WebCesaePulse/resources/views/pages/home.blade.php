@extends('master.master')

@section('content')
@auth
    <h1>Olá, {{ Auth::user()->name }}</h1>
@endauth
@endsection
