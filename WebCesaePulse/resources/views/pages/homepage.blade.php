@extends('master.master')

@section('title', 'Relógio de Ponto')

@section('header')
    Bem-vindo ao Relógio de Ponto
@endsection

@section('content')
<p>Aqui você pode registrar suas horas de entrada e saída.</p>

<button onclick="registrarEntrada()">Registrar Entrada</button>
<button onclick="registrarSaida()">Registrar Saída</button>>

    <script>
        function registrarEntrada() {
            alert("Entrada registrada!");
        }

        function registrarSaida() {
            alert("Saída registrada!");
        }
    </script>
@endsection


