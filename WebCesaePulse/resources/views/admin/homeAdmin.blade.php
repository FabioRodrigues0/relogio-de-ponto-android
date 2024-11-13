@extends('master.masterTwo')
@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="text-center my-2"><img
                                    src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                                    width="150">
                            </div>
                            <hr>
                            <h3 class="card-title mb-3">Olá, Admin {{ Auth::user()->name }}!</h3>
                            <div class="mb-2">
                                <img width="70px" height="70px"
                                    src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/defaultUser.png') }}"
                                    alt="" style="border-radius:50%"></td>

                            </div>
                            <p class="card-text fs-5 text-muted">Verificação e gestão utilizadores do Cesae</p>
                        </div>
                    </div>
                </div>
            </div>




            <div>
                <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="card mb-4 w-100 shadow">
                            <div class="card-header bg-purple fs-5 text-white text-center">Registo de Utilizadores
                            </div>

                            <div class="container mt-2 mb-2"> <label> </label>
                                <div class="row gy-2 gx-3 align-items-center">
                                    <div class="col-auto">
                                        <label class="visually-hidden" for="autoSizingInput">Filtro</label>
                                        <input type="text" class="form-control" id="autoSizingInput" placeholder="Nome">
                                    </div>

                                    <div class="col-auto">
                                        <label class="input-group date" id="datepicker">

                                            <label for="data"> </label>
                                            <input type="date" class="form-control" id="data" name="data">
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <label class="visually-hidden" for="autoSizingSelect">Departamento</label>
                                        <select class="form-select" id="autoSizingSelect">
                                            <option selected>tipo de trabalho</option>
                                            <option value="1">Remoto</option>
                                            <option value="2">Presencial</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>







                            <div class="card-body table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Perfil</th>
                                        <th>Nome</th>
                                            <th>Entrada</th>
                                            <th>Saída</th>
                                            <th>Total</th>
                                            <th>Regime</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($entrances as $user)
                                    <tr>
                                            <td class="align-middle"><img width="30px" height="30px"
                                            src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/defaultUser.png') }}" alt="" style="border-radius: 50%"></td>
                                            <td class="align-middle">{{ $user->name ?? 'Sem registos'}}</td>
                                            <td class="align-middle">{{ $user->entry_time ?? 'Sem registos'}}</td>
                                            <td class="align-middle">{{ $user->exit_time ?? '-'}}</td>
                                            <td class="align-middle">{{ $user->total_time }}</td>
                                        <td>
                                            @if(!empty($user->description) && $user->description == "Remote")
                                               <span class="badge bg-success">Remoto</span>
                                            @elseif(!empty($user->description) && $user->description == "In-Person")
                                               <span class="badge bg-primary">Presencial</span>

                                            @else
                                                Sem registos
                                            @endif
                                        </td>
                                            <td class="align-middle"><button class="btn btn-outline-dark">Ver</button>
                                            </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                               {{ $entrances->links('') }}
                            </div>


                            </div>

                        </div>

                    </div>

            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Total de Horas</h5>
                            <p class="card-text fs-4">{{ $totalHours  }}h</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Utilizadores Ativos</h5>
                            <p class="card-text fs-4">25</p> <!-- Este valor pode ser dinâmico -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Presenças</h5>
                            <p class="card-text fs-4">80</p> <!-- Este valor pode ser dinâmico -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Faltas</h5>
                            <p class="card-text fs-4">5</p> <!-- Este valor pode ser dinâmico -->
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-6 d-flex justify-content-center">
            <div class="card mb-4 w-100 shadow">
                <div class="card-header fs-5 text-center"> Ranking desempenho Utilizadores</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Funcionário</th>
                                <th scope="col">Horas Trabalhadas</th>
                                <th scope="col">Pontualidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>João Silva</td>
                                <td>160 h</td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 95%;"
                                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">95%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Maria Santos</td>
                                <td>155 h</td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 90%;"
                                            aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Pedro Costa</td>
                                <td>140 h</td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-3">
                <div class="card shadow" style="border-color: #5b1bd2;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b1bd2;">Notificações Recebidas</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Atraso 2h Joana Neves</li>
                            <li class="list-group-item">Atraso 2h Francisco Conceição</li>
                            <li class="list-group-item">Atraso 2h Francisco Conceição</li>
                        </ul>
                        <button class="btn btn-outline-dark mt-3">Ver</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow" style="border-color: #5b1bd2;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b1bd2;">Notas</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Enviar mensagem de Magusto dia 14/11</li>
                            <li class="list-group-item">Criar nova Conta do formador </li>
                            <li class="list-group-item">Enviar mensagem sobre a appClock para Android  </li>
                            <li class="list-group-item">Enviar mensagem de Parabéns, nova funcionalidade </li>
                        </ul>
                        <button class="btn btn-outline-dark mt-3">Adicionar notas</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow" style="border-color: #5b1bd2;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b1bd2;">Atividades</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Enviar Avisos <button class="btn btn-outline-dark">Enviar</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Emails dos funcionários <button class="btn btn-outline-dark">Consultar</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Verificar quem está online <button class="btn btn-outline-dark">Ver</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
