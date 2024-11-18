@extends('master.master')

@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <!-- Coluna de Informações do Funcionário -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="text-center mb-4">
                        <div class="text-center my-2"><img src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo" width="150"></div>
                        <hr>
                        <h3 class="card-title mb-3">Olá, {{ Auth::user()->name }}!</h3>

                        <p class="card-text text-muted">Aqui estão as suas informações de entrada e saída.</p>
                    </div>
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6 text-center">
                                <p class="card-text"><strong>Data:</strong> <span id="current-date"></span></p>
                            </div>

                            <div class="col-md-6 text-center">
                                <p class="card-text"><strong>Horas trabalhadas hoje:</strong> {{ $userTime->total_time ?? 'Sem registos' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6 text-center">
                                <p class="card-text"><strong>Última entrada:</strong> {{ $userTime->date." às ".$userTime->entry_time ?? 'Sem registos' }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <p class="card-text"><strong>Última saída:</strong> {{ $userTime->date." às ".$userTime->exit_time ?? 'Sem registos' }}</p>
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
                        <div class="card-header text-center">Horas Mensais</div>
                        <div class="card-body text-center">
                            @php
                            $punctuality = round($performance->punctuality_percentage);
                            @endphp
                            <p>Horas mensais trabalhadas até agora: <strong>{{ $performance->total_hours }}</strong></p>
                            @if($punctuality >= 90)
                            <p>Pontualidade: <span class="text-success">Ótimo! Manter assim!</span></p>
                            @elseif ($punctuality >= 70)
                            <p>Pontualidade: <span class="text-primary">Está bom!</span></p>
                            @elseif ($punctuality >= 50)
                            <p>Pontualidade: <span class="text-warning">Podes melhorar!</span></p>
                            @else
                            <p>Pontualidade: <span class="text-danger">Não está bom!</span></p>
                            @endif

                            <!-- Exemplo de Barra de Progresso -->
                            <div class="progress">


                            @if($punctuality >= 90)
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ round($performance->punctuality_percentage) }}%;"
                              aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">{{ round($performance->punctuality_percentage) }}%</div>
                          @elseif ($punctuality >= 70)
                             <div class="progress-bar bg-primary" role="progressbar" style="width: {{ round($performance->punctuality_percentage) }}%;"
                              aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">{{ round($performance->punctuality_percentage) }}%</div>
                          @elseif ($punctuality >= 50)
                              <div class="progress-bar bg-warning" role="progressbar" style="width: {{ round($performance->punctuality_percentage) }}%;"
                                  aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">{{ round($performance->punctuality_percentage) }}%</div>
                          @else
                              <div class="progress-bar bg-danger" role="progressbar" style="width: {{ round($performance->punctuality_percentage) }}%;"
                                 aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">{{ round($performance->punctuality_percentage) }}%</div>
                          @endif
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
                                        <th>Total (H)</th>
                                        <th>Regime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allUserData as $data)
                                    <tr>
                                        <td>{{ $data->date ?? 'Sem registos' }}</td>
                                        <td>{{ $data->entry_time ?? 'Sem registos' }}</td>
                                        <td>{{ $data->exit_time ?? 'Sem registos' }}</td>
                                        <td>{{ $data->total_time ?? 'Sem registos' }}</td>
                                        <td>
                                            @if(!empty($data->description) && $data->description == "Remote")
                                               {{-- <button type="button" class="btn btn-outline-success">Remoto</button> --}}
                                               <span class="badge bg-success">Remoto</span>
                                            @elseif(!empty($data->description) && $data->description == "In-Person")
                                               {{-- <button type="button" class="btn btn-outline-primary">Presencial</button> --}}
                                               <span class="badge bg-primary">Presencial</span>
                                            @else
                                                Sem registos
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $allUserData->links('') }}
                            </div>
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
