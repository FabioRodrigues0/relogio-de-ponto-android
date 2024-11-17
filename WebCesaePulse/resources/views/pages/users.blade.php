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
            <form method="GET" class="mb-4">
                <div class="input-group w-75 mx-auto">
                    <input type="text" name="search" value="{{ request()->query('search') }}"
                           class="form-control" placeholder="Pesquisar..." aria-label="Pesquisar">
                    <select class="form-select ms-2" name="type">
                        <option selected>Filtrar por tipo</option>
                        <option value="1" {{ request()->query('type') == '1' ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ request()->query('type') == '2' ? 'selected' : '' }}>Employee</option>
                    </select>
                    <button class="btn btn-blue ms-2" type="submit">
                        <i class="fa fa-search text-white"></i>
                    </button>
                </div>
            </form>

            <!-- Tabela de Resultados -->
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead style="background-color: #6f42c1; color: #ffffff;">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Setor</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($showUsers as $user)
                            <tr>
                                <td><img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/defaultUser.png') }}"
                                         alt="Foto de {{ $user->name }}" class="rounded-circle" width="40" height="40"></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->users_type_id == 1 ? 'bg-primary' : 'bg-secondary' }}">
                                        {{ $user->users_type_id == 1 ? 'Admin' : 'Funcionário' }}
                                    </span>
                                </td>
                                <td>{{ $user->setor }}</td>
                                <td class="text-center">
                                    <a href="{{ route('userContact.view', $user->id) }}" class="btn btn-outline-secondary btn-sm me-2" title="Atualizar">
                                        <i class="fa-solid fa-pen-to-square"></i> Atualizar
                                    </a>
                                    <a href="{{ route('users.delete', $user->id) }}" class="btn btn-outline-danger btn-sm" title="Apagar">
                                        <i class="fas fa-trash-alt"></i> Apagar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="d-flex justify-content-center mt-4">
            {{ $showUsers->links('') }}
        </div>
    </div>

@endsection
