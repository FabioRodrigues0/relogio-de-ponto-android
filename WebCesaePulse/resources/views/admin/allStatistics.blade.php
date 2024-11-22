@extends('master.masterTwo')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center m-1">
            <div class="col-lg-12 mt-4">
                <div class="card shadow mb-1">
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
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card text-white bg-primary mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Utilizadores Ativos Mensal</h5>
                                            <h3 class="card-text">{{ $getTotalUsers }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-success mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Horas Totais</h5>
                                            <h3 class="card-text">850</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-warning mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Presença Média</h5>
                                            <h3 class="card-text">6.3 dias</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-white bg-danger mb-3">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Crescimento</h5>
                                            <h3 class="card-text">+15%</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        <div>
        </div>
        <div class="container-fluid">
            <header class="mb-4">
                <h1 class="text-center"></h1>
            </header>

            <div class="row container-fluid-xxl mt-4">
                <!-- Coluna Esquerda (Gráfico Grande) -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow h-100">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Registos Mensais</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center mt-5">
                                <div
                                    style="width: 100%; height: 100%; background-color: #f0f0f0; text-align: center; line-height: 450px;">
                                    <canvas id="combinedPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coluna Direita (Dois Gráficos Empilhados) -->
                <div class="col-md-6 mb-4 d-flex flex-column">
                    <!-- Gráfico 1 -->
                    <div class="card shadow flex-fill mb-2">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Desempenho Diário</h5>
                        </div>
                        <div class="card-body shadow">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 100%; height: 100%; background-color: #f0f0f0; text-align: center; line-height: 300px;">
                                    <canvas id="dailyLineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfico 2 -->
                    <div class="card flex-fill">
                        <div class="card-header bg-purple text-white text-center">
                            <h5 class="mb-0">Horas Mensais</h5>
                        </div>
                        <div class="card-body shadow">
                            <div class="d-flex justify-content-center">
                                <div
                                    style="width: 100%; height: 100%; background-color: #f0f0f0; text-align: center; line-height: 300px;">
                                    <canvas id="combinedBarChart"></canvas>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                @php
                    $combinedLabels = []; // Unique months across all users

                    // Collect unique months from all users
                    foreach ($userData as $user) {
                        foreach ($user['attendance'] as $attendance) {
                            if (!in_array($attendance->month, $combinedLabels)) {
                                $combinedLabels[] = $attendance->month;
                            }
                        }
                    }

                @endphp

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

                        // Combined Bar Chart
                        const combinedLabels = {!! json_encode($combinedLabels) !!};

                        const userColors = [
                            'rgba(75, 192, 192, 0.5)', // Teal
                            'rgba(255, 99, 132, 0.5)', // Pink
                            'rgba(54, 162, 235, 0.5)', // Blue
                            'rgba(255, 206, 86, 0.5)', // Yellow
                            'rgba(153, 102, 255, 0.5)', // Purple
                            'rgba(201, 203, 207, 0.5)', // Grey
                            'rgba(255, 159, 64, 0.5)', // Orange
                        ];

                        const datasets = [
                            @foreach ($userData as $index => $user)
                                {
                                    label: "{{ $user['name'] }}",
                                    data: [
                                        @foreach ($combinedLabels as $label)
                                            @php
                                                $totalHours = 0;
                                                foreach ($user['attendance'] as $attendance) {
                                                    if ($attendance->month === $label) {
                                                        $totalHours = $attendance->total_hours;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $totalHours }},
                                        @endforeach
                                    ],
                                    backgroundColor: userColors[{{ $index }} % userColors.length],
                                    borderColor: userColors[{{ $index }} % userColors.length].replace('0.5', '1'),
                                    borderWidth: 1
                                },
                            @endforeach
                        ];

                        const combinedBarCtx = document.getElementById('combinedBarChart').getContext('2d');
                        new Chart(combinedBarCtx, {
                            type: 'bar',
                            data: {
                                labels: combinedLabels,
                                datasets: datasets
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        stacked: false
                                    },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        const lineChartLabels = {!! json_encode($chartLabels) !!}; // Dias no eixo X
                        const lineChartValues = {!! json_encode($chartValues) !!}; // Valores no eixo Y

                        const lineChartCtx = document.getElementById('dailyLineChart').getContext('2d');
                        new Chart(lineChartCtx, {
                            type: 'line',
                            data: {
                                labels: lineChartLabels,
                                datasets: [{
                                    label: 'Utilizadores Registados por Dia',
                                    data: lineChartValues,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 2,
                                    fill: true,
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Dias'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Número de Utilizadores'
                                        }
                                    }
                                }
                            }
                        });

                    });



                    // OUTRO CHART
                </script>
            @endsection
