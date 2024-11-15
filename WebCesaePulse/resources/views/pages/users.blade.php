@extends('master.master')

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="container mt-5">
            <h1 class="title-gradient text-center display-3">Consulta de funcionários</h1>
        </div>
        
        <div class="container my-4">
            <div class="row justify-content-center">
                <!-- Coluna de Informações do Funcionário -->
                <div class="col-lg-10">
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <form method="GET">
                                <div class="input-group w-50">
                                    <input
                                        value="{{ request()->query('search') }}"
                                        type="text"
                                        name="search"
                                        class="form-control"
                                        placeholder="Pesquisar..."
                                        aria-label="Pesquisar"
                                        aria-describedby="basic-addon2"
                                    >
                                    <select class="form-select ms-1" name="type" aria-label="Default select example" {{ request()->query('type') }}>
                                        <option selected>Filtrar por tipo</option>
                                        <option value="1" >Admin</option>
                                        <option value="2" >Employee</option>
                                      </select>
                                    <button class="btn btn-outline-success" type="submit" id="basic-addon2">
                                        Procurar
                                    </button>

                                </div>

                            </form>
                        </div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">#ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo</th>
                <th scope="col">Setor</th>
              </tr>
            </thead>
            <tbody>
                @foreach($showUsers as $users)
              <tr>
                <td><img width="30px" height="30px"
                    src="{{ $users->foto ? asset('storage/' . $users->foto) : asset('images/defaultUser.png') }}" alt="" style="border-radius: 50%"></td>
                <th scope="row">{{ $users->id }}</th>
                <td>{{ $users->name }}</td>
                <td>{{ $users->email }}</td>
                <td>{{ $users->type }}</td>
                <td>{{ $users->setor }}</td>
                <td><a href="{{ route('userContact.view', $users->id) }}" class="btn btn-outline-dark" title="Detalhes">
                    <i class="fa-solid fa-pen-to-square"></i> Atualizar
                </a>
                <a href="{{ route('users.delete', $users->id) }}" class="btn btn-outline-danger ms-2">
                    <i class="fas fa-trash-alt"></i> Apagar
                </a>

              </tr>
              @endforeach
            </tbody>

          </table>
          <div class="d-flex justify-content-center">
            {{ $showUsers->links('') }}
        </div>
    </div>
    </div>
</div>
</div>
</div>
</div>


@endsection
