
@extends('master.masterTwo')
@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="text-center my-2"><img src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo" width="150">
                        </div>
                        <hr>
                        <h3 class="card-title mb-3">Olá, Admin {{ Auth::user()->name }}!</h3>
                        <p class="card-text fs-5 text-muted">Verificação e gestão utilizadores do Cesae</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 d-flex justify-content-center">
                <div class="card mb-4 w-100 shadow">
                    <div class="card-header bg-purple fs-5 text-white text-center">Registo de Utilizadores </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Entrada</th>
                                        <th>Saída</th>
                                        <th>Total</th>
                                        <th>Regime</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td class="align-middle">a</td>
                                        <td class="align-middle">b</td>
                                        <td class="align-middle">c</td>
                                        <td class="align-middle">e</td>
                                        <td class="align-middle"><span class="badge bg-primary">Presencial</span></td>
                                        <td class="align-middle"><button class="btn btn-outline-dark">Ver</button></td>

                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{-- {{ $allUserData->links('') }} --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


