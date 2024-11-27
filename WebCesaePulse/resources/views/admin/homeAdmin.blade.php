@extends('master.masterTwo')
@section('content')
    <div class="container my-4">
        @if (session('message'))
            <div id="success-alert" class="alert alert-success">{{ session('message') }}</div>
        @endif
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
                            <h3 class="card-title mb-3">Olá, Admin {{ Auth::user()->name }}!
                            </h3>

                            <div class="mb-2">
                                <img width="70px" height="70px"
                                    src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/defaultUser.png') }}"
                                    alt="" style="border-radius:50%"></td>
                            </div>
                            <p class="card-text fs-5 text-muted">Verificação e gestão utilizadores do Cesae</p>

                            @if ($alerts->count() > 0)
                                <a href="#alerts" class="no-link-style">
                                    <div class="card shadow card-alert">
                                        <div class="card-body text-center">
                                            <svg class="notification m-3" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                width="50" height="50" viewBox="0 0 50 50" style="fill:#FAB005;">
                                                <path
                                                    d="M 25 0 C 22.800781 0 21 1.800781 21 4 C 21 4.515625 21.101563 5.015625 21.28125 5.46875 C 15.65625 6.929688 12 11.816406 12 18 C 12 25.832031 10.078125 29.398438 8.25 31.40625 C 7.335938 32.410156 6.433594 33.019531 5.65625 33.59375 C 5.265625 33.878906 4.910156 34.164063 4.59375 34.53125 C 4.277344 34.898438 4 35.421875 4 36 C 4 37.375 4.84375 38.542969 6.03125 39.3125 C 7.21875 40.082031 8.777344 40.578125 10.65625 40.96875 C 13.09375 41.472656 16.101563 41.738281 19.40625 41.875 C 19.15625 42.539063 19 43.253906 19 44 C 19 47.300781 21.699219 50 25 50 C 28.300781 50 31 47.300781 31 44 C 31 43.25 30.847656 42.535156 30.59375 41.875 C 33.898438 41.738281 36.90625 41.472656 39.34375 40.96875 C 41.222656 40.578125 42.78125 40.082031 43.96875 39.3125 C 45.15625 38.542969 46 37.375 46 36 C 46 35.421875 45.722656 34.898438 45.40625 34.53125 C 45.089844 34.164063 44.734375 33.878906 44.34375 33.59375 C 43.566406 33.019531 42.664063 32.410156 41.75 31.40625 C 39.921875 29.398438 38 25.832031 38 18 C 38 11.820313 34.335938 6.9375 28.71875 5.46875 C 28.898438 5.015625 29 4.515625 29 4 C 29 1.800781 27.199219 0 25 0 Z M 25 2 C 26.117188 2 27 2.882813 27 4 C 27 5.117188 26.117188 6 25 6 C 23.882813 6 23 5.117188 23 4 C 23 2.882813 23.882813 2 25 2 Z M 27.34375 7.1875 C 32.675781 8.136719 36 12.257813 36 18 C 36 26.167969 38.078125 30.363281 40.25 32.75 C 41.335938 33.941406 42.433594 34.6875 43.15625 35.21875 C 43.515625 35.484375 43.785156 35.707031 43.90625 35.84375 C 44.027344 35.980469 44 35.96875 44 36 C 44 36.625 43.710938 37.082031 42.875 37.625 C 42.039063 38.167969 40.679688 38.671875 38.9375 39.03125 C 35.453125 39.753906 30.492188 40 25 40 C 19.507813 40 14.546875 39.753906 11.0625 39.03125 C 9.320313 38.671875 7.960938 38.167969 7.125 37.625 C 6.289063 37.082031 6 36.625 6 36 C 6 35.96875 5.972656 35.980469 6.09375 35.84375 C 6.214844 35.707031 6.484375 35.484375 6.84375 35.21875 C 7.566406 34.6875 8.664063 33.941406 9.75 32.75 C 11.921875 30.363281 14 26.167969 14 18 C 14 12.261719 17.328125 8.171875 22.65625 7.21875 C 23.320313 7.707031 24.121094 8 25 8 C 25.886719 8 26.679688 7.683594 27.34375 7.1875 Z M 21.5625 41.9375 C 22.683594 41.960938 23.824219 42 25 42 C 26.175781 42 27.316406 41.960938 28.4375 41.9375 C 28.792969 42.539063 29 43.25 29 44 C 29 46.222656 27.222656 48 25 48 C 22.777344 48 21 46.222656 21 44 C 21 43.242188 21.199219 42.539063 21.5625 41.9375 Z">
                                                </path>
                                            </svg> Tens alertas!
                                        </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row d-flex justify-content-center">
                <div class="col-10 d-flex justify-content-center">
                    <div class="card mb-4 w-100 shadow">
                        <div class="card-header bg-purple fs-5 text-white text-center">Registo de Utilizadores
                        </div>

                        <form method="get" action="{{ route('admin.get') }}">
                            <div class="fs-5 mt-2 text-center form-control " style="display: flex; justify-content: center; align-items: center;">
                                {{-- {{ $actualDayMonthYear }} --}}

                                {{-- <button class="btn btn-outline-secondary dropdown-toggle p-0" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="border: none; background: none; width: 30px; text-align: center;">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($registers as $day)
                                        <li>
                                            <button class="dropdown-item" type="submit" name="date"
                                                value="{{ $day->day }}">{{ $day->day }}</button>
                                        </li>
                                    @endforeach
                                </ul> --}}
                                <select name="date" class="form-select " aria-label="Default select example"
                                    onchange="this.form.submit()" style="width: 140px; text-align: center;">
                                    @foreach ($registers as $day)
                                        <option value="{{ $day->day }}"
                                            @if ($day->day == $actualDayMonthYear) selected @endif>
                                            {{ $day->day }}
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <div class="container mb-2"> <label> </label>

                            {{-- <form method="GET" action="{{ route('admin.search') }}">
                                @csrf --}}

                            <div class="row gy-2 gx-3 align-items-center">
                                {{-- <div class="col-auto">
                                        <label class="visually-hidden" for="autoSizingInput">Filtro</label> --}}

                                {{-- <input type="text" name="searchName"
                                            class="form-control" placeholder="Procurar..." aria-label="Pesquisar"
                                            aria-describedby="basic-addon2">
                                    </div>

                                    <div class="col-auto">
                                        <label class="visually-hidden" for="autoSizingSelect">Departamento</label>
                                        <select class="form-select" id="autoSizingSelect" name="attendance_mode">
                                            <option selected>Regime</option>
                                            <option value="1"
                                                {{ request()->query('attendance_mode') == '1' ? 'selected' : '' }}>Remoto
                                            </option>
                                            <option value="2"
                                                {{ request()->query('attendance_mode') == '2' ? 'selected' : '' }}>
                                                Presencial</option>
                                        </select> --}}
                                {{-- </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div> --}}
                                {{-- </form> --}}

                                {{-- <div class="col-auto ms-auto">
                                <form action="{{ route('admin.search') }}" method="GET">
                                    @csrf --}}
                                {{-- <div class="card-text fs-5 mb-1 text-muted text-center">
                                        Período temporal
                                    </div>
                                    <label class="input-group date" id="datepicker">
                                        <label for="data"> </label>
                                        <input type="date" class="form-control" id="date" name="date">
                                        <label for="data"> </label>
                                        <input type="date" class="form-control" id="dateTwo" name="dateTwo">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i></button>
                                    </label> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                        </form>
                        <div class="card-body table-responsive">
                            <table class="table table-striped" id="data-tableAdmin">
                                <thead>
                                    <tr>
                                        <th>Perfil</th>
                                        <th>Nome</th>
                                        <th>Entrada</th>
                                        <th>Saída</th>
                                        <th>Total</th>
                                        <th>Regime</th>
                                        <th>Estado</th>
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
                                                @elseif(!empty($user->description) && $user->description == 'External')
                                                    <span class="badge bg-info">Externo</span>
                                                @else
                                                    Sem registos
                                                @endif
                                            </td>
                                            {{-- <td class="align-middle"><button class="btn btn-outline-dark">Ver</button> --}}

                                            @if ($user->exit_time)
                                                <td class="align-middle">
                                                    <div class="ballDivInactive"></div>
                                                @else
                                                <td class="align-middle">
                                                    <div class="ballDivActive"></div>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-center shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Total de Horas</h5>
                                    @if($totalHours > 0)
                                    <p class="card-text fs-4" style="color: #1E0C3C)">{{ $totalHours }}h</p>
                                    @else
                                    <p class="card-text fs-4">{{ $totalHours }}h</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Utilizadores Ativos</h5>
                                    @if($cont > 0)
                                    <p class="card-text fs-4" style="color: rgb(0, 223, 0)">{{ $cont }}</p>
                                    @else
                                    <p class="card-text fs-4">{{ $cont }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Presenças</h5>
                                    @if($presences > 0)
                                    <p class="card-text fs-4" style="color: green">{{ $presences }}</p>
                                    @else
                                    <p class="card-text fs-4">{{ $presences }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Faltas</h5>
                                    @if($totalUserAbsence > 0)
                                    <p class="card-text fs-4" style="color: red">{{ $totalUserAbsence }}</p>
                                    @else
                                    <p class="card-text fs-4">{{ $totalUserAbsence }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    <div class="card mb-4 shadow ">
                        <div class="card-header fs-5 text-center"> Ranking horas mensais Utilizadores - Mês
                            {{ $actualMonthYear }}
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped" id="data-tablePerformance">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Funcionário</th>
                                        <th scope="col">Horas Trabalhadas</th>
                                        <th scope="col">Setor</th>
                                        <th scope="col">Pontualidade</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($userPerformance as $user)

                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->total_hours }}h</td>
                                            <td>{{ $user->setor }}</td>
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
                                                        <div class="progress-bar bg-danger" role="progressbar"
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
                            {{-- <div class="d-flex justify-content-center">
                                {{ $userPerformance->links('') }}
                            </div> --}}
                        </div>

                    </div>

                </div>
                <div class="col-lg-10 d-flex justify-content-center mt-3">
                    <div class="card mb-4 w-100 shadow">
                        <div id="alerts" class="card-header bg-warning text-white text-center alerts">Alertas</div>
                        <div class="card-body">
                            <ul>
                                @if ($alerts->isEmpty())
                                    <li>Não há solicitações de alteração de palavra-passe pendentes.</li>
                                @else
                                    @foreach ($alerts as $alert)
                                        <li class="d-flex justify-content-between align-items-center">
                                            <span>
                                                Solicitação de alteração de palavra-passe pendente para o utilizador com o
                                                email:
                                                <b>
                                                    {{ $alert->email }}.</b>
                                            </span>
                                            <form action="{{ route('admin.password', $alert->users_id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-success m-1">Concluído</button>
                                            </form>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $alerts->links('') }}
                        </div>

                    </div>
                </div>




                {{-- <div class="row justify-content-center">
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
            </div> --}}

                {{-- <div class="col-8 d-flex justify-content-center">
            <div class="card shadow" style="border-color: #5b1bd2;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #5b1bd2;">Atividades</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Gerar aviso geral
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-bs-whatever="@mdo">Enviar alertas </button>
                        </li>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">

                            <div class="modal-dialog modal-lg modal-dialog-centered w-100">
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
                            Verificar faltas <button class="btn btn-outline-dark">Ver</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div> --}}


            @endsection
