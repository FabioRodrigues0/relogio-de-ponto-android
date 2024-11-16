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
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="card mb-4 w-100 shadow">
                            <div class="card-header bg-purple fs-5 text-white text-center">Registo de Utilizadores
                            </div>
                            <div class="fs-5 mt-2 text-center form-control">{{ $actualDayMonthYear }}
                            </div>
                            <div class="container mb-2"> <label> </label>

                                <form method="GET">
                                    <div class="row gy-2 gx-3 align-items-center">
                                        <div class="col-auto">
                                            <label class="visually-hidden" for="autoSizingInput">Filtro</label>

                                            <input value="{{ request()->query('search') }}" type="text" name="search"
                                                class="form-control" placeholder="Procurar..." aria-label="Pesquisar"
                                                aria-describedby="basic-addon2">
                                        </div>

                                        <div class="col-auto">
                                            <label class="visually-hidden" for="autoSizingSelect">Departamento</label>
                                            <select class="form-select" id="autoSizingSelect" name="attendance_mode">
                                                <option selected>Regime</option>
                                                <option value="1"
                                                    {{ request()->query('attendance_mode') == '1' ? 'selected' : '' }}>
                                                    Remoto</option>
                                                <option value="2"
                                                    {{ request()->query('attendance_mode') == '2' ? 'selected' : '' }}>
                                                    Presencial</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>

                                </form>
                                <div class="col-auto ms-auto">
                                    <label class="input-group date" id="datepicker">

                                        <label for="data"> </label>
                                        <input type="date" class="form-control" id="data" name="data">
                                    </label>
                                </div>
                            </div>
                        </div>
                        </form>






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
                                    @foreach ($entrances as $user)
                                        <tr>
                                            <td class="align-middle"><img width="30px" height="30px"
                                                    src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/defaultUser.png') }}"
                                                    alt="" style="border-radius: 50%"></td>
                                            <td class="align-middle">{{ $user->name ?? 'Sem registos' }}</td>
                                            <td class="align-middle">{{ $user->entry_time ?? 'Sem registos' }}</td>
                                            <td class="align-middle">{{ $user->exit_time ?? '-' }}</td>
                                            <td class="align-middle">{{ $user->total_time }}</td>
                                            <td>
                                                @if (!empty($user->description) && $user->description == 'Remote')
                                                    <span class="badge bg-success">Remoto</span>
                                                @elseif(!empty($user->description) && $user->description == 'In-Person')
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
                            <p class="card-text fs-4">{{ $totalHours }}h</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Utilizadores Ativos</h5>
                            <p class="card-text fs-4">{{ $cont }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Presenças</h5>
                            <p class="card-text fs-4">{{ $presences }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h5 class="card-title">Faltas</h5>
                            <p class="card-text fs-4">Sem dados</p> <!-- Este valor pode ser dinâmico -->
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
                <div class="card-header fs-5 text-center"> Ranking desempenho Utilizadores - Mês {{ $actualMonthYear }}
                </div>
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
                            @foreach ($userPerformance as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->total_hours }}h</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            @php
                                                $punctuality = round($user->punctuality_percentage);
                                            @endphp
                                            @if ($punctuality >= 90)
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ round($user->punctuality_percentage) }}%;"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                                    {{ round($user->punctuality_percentage) }}%</div>
                                            @elseif ($punctuality >= 70)
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ round($user->punctuality_percentage) }}%;"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                                    {{ round($user->punctuality_percentage) }}%</div>
                                            @elseif ($punctuality >= 50)
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ round($user->punctuality_percentage) }}%;"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                                    {{ round($user->punctuality_percentage) }}%</div>
                                            @else
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ round($user->punctuality_percentage) }}%;"
                                                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                                    {{ round($user->punctuality_percentage) }}%</div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $userPerformance->links('') }}
                    </div>
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
                        <div class="d-flex justify-content-center">

                            <button class="btn btn-outline-dark mt-3">Ver</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card shadow" style="border-color: #5b1bd2;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #5b1bd2;">Atividades</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Enviar Alertas
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-bs-whatever="@mdo">Enviar alertas </button>
                            </li>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <!-- Modificação: Adicione "modal-dialog-centered" -->
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Enviar Alerta</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">e-mail:</label>
                                                    <input type="text" class="form-control" id="recipient-name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Messagem:</label>
                                                    <textarea class="form-control" id="message-text"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fechar</button>
                                            <button type="button" class="btn btn-outline-dark">Enviar alerta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
