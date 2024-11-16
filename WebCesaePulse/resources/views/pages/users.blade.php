@extends('master.master')

@section('content')
    <div class="container my-4">
        @if (session('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
        @endif

        <!-- Card Principal para a Consulta de Funcionários -->
        <div class="card shadow-lg mb-4">
            <div class="card-header bg-purple text-white text-center fs-4">Consulta de Funcionários</div>
            <div class="card-body">

                <!-- Formulário de Pesquisa e Filtro -->
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
                                    <td>{{ $user->type == 1 ? 'Admin' : 'Employee' }}</td>
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

                <!-- Paginação Centralizada -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $showUsers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

