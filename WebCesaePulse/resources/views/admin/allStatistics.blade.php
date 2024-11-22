@extends('master.masterTwo')

@section('content')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 mt-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="text-center my-2"><img
                                    src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                                    width="150">
                            </div>
                            <hr>
                            <h3 class="card-title mb-3 ">Estatísticas Gerais
                            </h3>
                            <p class="card-text fs-5 text-muted">Consulta as estatísticas do Cesae</p>
                            <hr>
                            <div class="row mt-4 ">
                                <div class="col-md-4 mb-3">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h5 class="card-title">Total de Horas</h5>
                                            <p class="card-text fs-3">5.200</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card text-white bg-success">
                                        <div class="card-body">
                                            <h5 class="card-title">Novos Utilizadores</h5>
                                            <p class="card-text fs-3">1.300</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card text-white bg-warning">
                                        <div class="card-body">
                                            <h5 class="card-title">Utilizadores em Destaque</h5>
                                            <p class="card-text fs-3">2.500</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
        <div class="container-fluid mt-5 ">
            <header class="mb-4">
                <h1 class="text-center"></h1>
            </header>

            <!-- Cartões de Estatísticas -->


            <div class="row container-fluid-xxl">
                <!-- Gráfico 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Gráfico 1</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 80%; height: 250px; background-color: #f0f0f0; text-align: center; line-height: 250px;">
                                    Gráfico 1
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico 2 (Gráfico Central - Foco) -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Desempenho Mensal</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 90%; height: 250px; background-color: #f0f0f0; text-align: center; line-height: 300px;">
                                    Gráfico Central
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Gráfico 3</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 80%; height: 250px; background-color: #f0f0f0; text-align: center; line-height: 250px;">
                                    Gráfico 3
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Cartões de Estatísticas -->


            <div class="row container-fluid-xxl mt-4">
                <!-- Gráfico 1 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Número Registos Mensais</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 80%; height: 450px; background-color: #f0f0f0; text-align: center; line-height: 250px;">
                                    <canvas id="combinedPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico 2 (Gráfico Central - Foco) -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Desempenho Mensal</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 90%; height: 450px; background-color: #f0f0f0; text-align: center; line-height: 300px;">
                                    Gráfico Central
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const combinedPieLabels = [
                            @foreach ($userData as $user)
                                "{{ $user['name'] }}",
                            @endforeach
                        ];

                        const combinedPieValues = [
                            @foreach ($userData as $user)
                                @php
                                    $userTotalPresent = 0;
                                    foreach ($user['attendance'] as $attendance) {
                                        $userTotalPresent += $attendance->attendance_days;
                                    }
                                @endphp
                                {{ $userTotalPresent }},
                            @endforeach
                        ];


                        const combinedPieCtx = document.getElementById('combinedPieChart').getContext('2d');
                        new Chart(combinedPieCtx, {
                            type: 'pie',
                            data: {
                                labels: combinedPieLabels,
                                datasets: [{
                                    data: combinedPieValues,
                                    backgroundColor: [
                                        'rgba(75, 192, 192, 0.5)',
                                        'rgba(255, 99, 132, 0.5)',
                                        'rgba(54, 162, 235, 0.5)',
                                        'rgba(255, 206, 86, 0.5)',
                                        'rgba(153, 102, 255, 0.5)',
                                        'rgba(201, 203, 207, 0.5)'
                                    ],
                                    borderColor: [
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(201, 203, 207, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    });
                </script>
            @endsection
