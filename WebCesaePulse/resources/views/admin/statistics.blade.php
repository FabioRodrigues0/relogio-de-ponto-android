@extends('master.masterTwo')
@section('content')
    <div class="container mt-5">
        <h1 class="title-gradient text-center display-3">Estatística</h1>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($userData as $userId => $user)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user['name'] }}</h5>
                            <canvas id="attendanceChart-{{ $userId }}"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($userData as $userId => $user)
                // Prepare data for the chart
                const labels{{ $userId }} = {!! json_encode($user['attendance']->pluck('month')) !!};
                const data{{ $userId }} = {!! json_encode($user['attendance']->pluck('total_hours')) !!};
                const daysData{{ $userId }} = {!! json_encode($user['attendance']->pluck('attendance_days')) !!};

                // Create the chart
                const ctx{{ $userId }} = document.getElementById('attendanceChart-{{ $userId }}')
                    .getContext('2d');
                new Chart(ctx{{ $userId }}, {
                    type: 'bar',
                    data: {
                        labels: labels{{ $userId }},
                        datasets: [{
                                label: 'Total Hours Worked',
                                data: data{{ $userId }},
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Days Present',
                                data: daysData{{ $userId }},
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            @endforeach
        });
    </script>
@endsection
