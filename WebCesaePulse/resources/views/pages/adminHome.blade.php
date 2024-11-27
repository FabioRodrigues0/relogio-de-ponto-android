@extends('master.masterTwo')

@section('content')
    <div class="container my-4">
        @if (session('message'))
            <div id="success-alert" class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="text-center my-2"><img
                                    src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                                    width="150"></div>
                            <hr>
                            <h3 class="card-title mb-3">Olá, {{ Auth::user()->name }}!</h3>
                            <p class="card-text text-muted">Aqui estão as tuas informações de entrada e saída.</p>
                        </div>
                        <div class="container">
                            <div class="row mb-3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 text-center">
                                    <p class="card-text"><strong>Última entrada:</strong>
                                        @if($userTime === null || $userTime->date === null && $userTime->entry_time === null)
                                         Sem registos
                                        @else
                                        {{ $userTime->date ?? 'Sem registos' }} às {{ $userTime->entry_time ?? 'Sem registos' }}
                                        @endif
                                </div>
                                <div class="col-md-6 text-center">
                                    <p class="card-text"><strong>Última saída:</strong>
                                     @if($userTime === null || $userTime->exit_time === null)

                                        Sem registos
                                        @else
                                        {{ $userTime->date ?? 'Sem registos' }} às {{ $userTime->exit_time ?? 'Sem registos' }}</p>
                                        @endif
                                </div>
                            </div>
                            <hr>
                            <p class="card-text text-center fs-5"><strong><span id="current-date"></span></strong></p>
                            <div class="col-md-12 d-flex justify-content-center align-items-center text-center">

                            @if($loggedToday == false)
                            <form action="{{ route('user.checkIn') }}" method="POST">
                                @csrf
                                <div class="card shadow card-alert " style="width: 16rem;">
                                    <div class="card-body text-center">

                                    {{-- ADICIONADO TESTE 25/11/2024 --}}
                                    <select class="form-select form-select-sm mb-2" aria-label="Small select example" required
                                    name ="users_type_id">
                                    <option disabled selected value="">-</option>

                                        <option value="1">Presencial</option>
                                        <option value="2">Remoto</option>
                                        <option value="3">Serviço Externo</option>

                                   </select>
                                  {{-- ADICIONADO TESTE FIM  25/11/2024 --}}

                                <div class="d-flex justify-content-center">

                                    <button class="btn btn-success "
                                        style="height: 90px; width: 90px; border-radius: 50%;">Dar Entrada</button>
                                </div>
                            </div>
                        </div>
                            </form>
                            @elseif($loggedOutToday == false)
                            <form action="{{ route('user.checkOut') }}" method="POST">
                                @csrf
                                <div class="card shadow card-alert " style="width: 16rem;">

                                    <div class="card-body text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger "
                                        style="height: 90px; width: 90px; border-radius: 50%;">Dar Saída</button>
                                </div>
                                 </div>
                            </div>
                            </form>
                            @else
                            <div class="d-flex justify-content-center">
                            <strong class="text-center">Horas trabalhadas hoje: </strong>
                            </div class="d-flex justify-content-center">
                                    <div class=" ms-1 d-flex justify-content-center">
                                    {{ $userTime->total_time }}
                                    </div>
                            @endif
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="card mb-4 w-100 shadow">
                        <div class="card-header bg-purple fs-5 text-white text-center">Histórico de Ponto</div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped" id="data-table">
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
                                    @foreach ($allUserData as $data)
                                        <tr>
                                            <td>{{ $data->date ?? 'Sem registos' }}</td>
                                            <td>{{ $data->entry_time ?? 'Sem registos' }}</td>
                                            <td>{{ $data->exit_time ?? 'Sem registos' }}</td>
                                            <td>{{ $data->total_time ?? 'Sem registos' }}</td>
                                            <td>
                                                @if (!empty($data->description) && $data->description == 'Remote')
                                                    <span class="badge bg-success">Remoto</span>
                                                @elseif(!empty($data->description) && $data->description == 'In-Person')
                                                    <span class="badge bg-primary">Presencial</span>
                                                @elseif(!empty($data->description) && $data->description == 'External')
                                                    <span class="badge bg-info">Externo</span>
                                                @else
                                                    Sem registos
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="d-flex justify-content-center">
                                {{ $allUserData->links('') }}
                            </div> --}}
                        </div>
                    </div>
                </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 mb-4 d-flex justify-content-center">
                        <div class="card w-100 shadow">
                            <div class="card-header bg-purple text-white text-center">Horas Mensais</div>
                            <div class="card-body text-center">
                                @php
                                    $punctuality = round($performance->punctuality_percentage ?? -1);
                                @endphp
                                <p>Horas mensais trabalhadas até agora: <strong>{{ $performance->total_hours ?? 'Sem registos' }}</strong></p>
                                @if ($punctuality >= 90)
                                    <p>Pontualidade: <span class="text-success">Ótimo! Manter assim!</span></p>
                                @elseif ($punctuality >= 70)
                                    <p>Pontualidade: <span class="text-primary">Está bom!</span></p>
                                @elseif ($punctuality >= 50)
                                    <p>Pontualidade: <span class="text-warning">Podes melhorar!</span></p>
                                @elseif ($punctuality == -1)
                                    <p>Pontualidade: <span class="text-secondary">Sem registos</span></p>
                                @else
                                    <p>Pontualidade: <span class="text-danger">Não está bom!</span></p>
                                @endif

                                <div class="progress">
                                    @if ($punctuality >= 90)
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ round($performance->punctuality_percentage) }}%;"
                                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                            {{ round($performance->punctuality_percentage) }}%</div>
                                    @elseif ($punctuality >= 70)
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ round($performance->punctuality_percentage) }}%;"
                                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                            {{ round($performance->punctuality_percentage) }}%</div>
                                    @elseif ($punctuality >= 50)
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ round($performance->punctuality_percentage) }}%;"
                                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                            {{ round($performance->punctuality_percentage) }}%</div>
                                    @else
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ round($performance->punctuality_percentage ?? 0) }}%;"
                                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                            {{ round($performance->punctuality_percentage ?? 0) }}%</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 d-flex justify-content-center">
                        <div class="card w-100 shadow">
                            <div class="card-header bg-purple text-white text-center">Última solicitação password</div>
                            <div class="card-body">
                                @if (is_null($lastPwRequest))
                                <p class="text-center">Ainda não efetuaste pedidos de password.</p>
                                @elseif (is_null($lastPwRequest->updated_at))
                                <p class="text-center">Ainda não há registos de alteração password.</p>
                               @else
                               <p class="text-center">A última atualização de alteração de password foi efetuada no dia {{ \Carbon\Carbon::parse($lastPwRequest->created_at)->format('d/m/Y') }}.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-12 d-flex justify-content-center">
                        <div class="card mb-4 w-100 shadow">
                            <div class="card-header bg-warning text-white text-center">Alertas</div>
                            <div class="card-body">
                                <ul>
                                    @if ($userAlerts)
                                        <li>Tens um pedido de alteração de password pendente.</li>
                                    @else
                                        <li>Não tens alertas pendentes.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
