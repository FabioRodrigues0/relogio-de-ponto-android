@extends('master.masterTwo')

@section('content')
    <div class="container mt-5">
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card shadow-lg border-light mb-4 ">
            <div class="card-body text-center">
                <div class="text-center my-2"><img
                    src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                    width="150">
            </div>
            <hr>
                <h1 class="title-gradient display-4 mb-2">Consulta de Funcionários</h1>
                <p class="text-muted">Encontre, edite ou exclua os funcionários registados no sistema.</p>
            </div>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Funcionários -->
        <div class="card shadow-lg">

            <div class="card-header bg-purple fs-5 text-white text-center">Utilizadores
            </div>

            <div class="card-body">
                <form method="GET" class="d-flex justify-content-between align-items-center mb-3">
                    <div class="input-group w-50">
                        <input
                            value="{{ request()->query('search') }}"
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Pesquisar por nome ou e-mail"
                            aria-label="Pesquisar"
                        >
                        <select class="form-select ms-2" name="type" aria-label="Filtrar por tipo">
                            <option value="">Filtrar por tipo</option>
                            <option value="1" {{ request()->query('type') == '1' ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ request()->query('type') == '2' ? 'selected' : '' }}>Funcionário</option>
                        </select>
                        <button class="btn btn-outline-success ms-2" type="submit">
                            <i class="fa fa-search"></i> Procurar
                        </button>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">#ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Setor</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($showUsers as $users)
                            <tr>
                                <td>
                                    <img width="40px" height="40px"
                                        src="{{ $users->foto ? asset('storage/' . $users->foto) : asset('images/defaultUser.png') }}"
                                        alt="Foto de perfil"
                                        class="rounded-circle">
                                </td>
                                <th scope="row">{{ $users->id }}</th>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>
                                    <span class="badge {{ $users->users_type_id == 1 ? 'bg-primary' : 'bg-secondary' }}">
                                        {{ $users->users_type_id == 1 ? 'Admin' : 'Funcionário' }}
                                    </span>
                                </td>
                                <td>{{ $users->setor }}</td>
                                <td>
                                    <!-- Botões de ação com tooltips -->
                                    <a href="{{ route('userContact.view', $users->id) }}" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" title="Atualizar">
                                        <i class="fa-solid fa-pen-to-square"></i> Atualizar
                                    </a>
                                    <a href="{{ route('users.delete', $users->id) }}" class="btn btn-outline-danger btn-sm ms-2" data-bs-toggle="tooltip" title="Excluir">
                                        <i class="fas fa-trash-alt"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $showUsers->links('') }}
        </div>
    </div>

@endsection
