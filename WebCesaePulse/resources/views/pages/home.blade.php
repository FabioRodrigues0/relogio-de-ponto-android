@extends('master.master')

@section('content')

        <div class="container my-4">
            <div class="row justify-content-center">
                <!-- Coluna de Informações do Funcionário -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h3 class="card-title mb-3">Bem-vindo, {{ Auth::user()->name }}!</h3>
                                <p class="card-text text-muted">Aqui estão suas informações de entrada e saída.</p>
                            </div>
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-md-6 text-center">
                                        <p class="card-text"><strong>Data:</strong> 09/11/2024</p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <p class="card-text"><strong>Horas trabalhadas hoje:</strong> 8 horas</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 text-center">
                                        <p class="card-text"><strong>Última entrada:</strong> 08:00 AM</p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <p class="card-text"><strong>Última saída:</strong> 17:00 PM</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Coluna do Dashboard Principal -->
                <div class="col-lg-8 ">
                    <div class="row">
                        <!-- Painel de Horas e Produtividade -->
                        <div class="col-lg-6 mb-4 d-flex justify-content-center">
                            <div class="card w-100 shadow">
                                <div class="card-header text-center">Horas Semanais</div>
                                <div class="card-body text-center">
                                    <p>Horas trabalhadas até agora: <strong>32h</strong></p>
                                    <p>Saldo de horas: <span class="text-success">+2h</span></p>
                                    <!-- Exemplo de Barra de Progresso -->
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 80%;"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="40">80%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Painel de Avisos -->
                        <div class="col-lg-6 mb-4 d-flex justify-content-center">
                            <div class="card w-100 shadow">
                                <div class="card-header text-center">Avisos do Cesae</div>
                                <div class="card-body">
                                    <p>Reunião geral na sexta-feira, dia 10/11, às 15:00.</p>
                                    <p>Próxima revisão de ponto: dia 15/11.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Histórico de Ponto -->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="card mb-4 w-100 shadow">
                                <div class="card-header bg-purple text-white text-center">Histórico de Ponto</div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Entrada</th>
                                                <th>Saída</th>
                                                <th>Total do Dia</th>
                                                <th>Modalidade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>08/11/2024</td>
                                                <td>08:00</td>
                                                <td>17:00</td>
                                                <td>8h</td>
                                                <td><button type="button" class="btn btn-outline-primary">Remoto</button></td>
                                            </tr>
                                            <tr>
                                                <td>07/11/2024</td>
                                                <td>08:15</td>
                                                <td>16:45</td>
                                                <td>8h 30m</td>
                                                <td><button type="button" class="btn btn-outline-success">Presencial</button>
                                                </td>
                                            </tr>
                                            <!-- Mais registros podem ser adicionados aqui -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <div class="card mb-4 w-100 shadow">
                                <div class="card-header bg-warning text-white text-center">Alertas</div>
                                <div class="card-body">
                                    <ul>
                                        <li>Tens <strong>2 horas</strong> extras pendentes para compensação.</li>
                                        <li>Falta justificar uma ausência do dia 07/11.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
   
@endsection
