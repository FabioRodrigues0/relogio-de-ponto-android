@extends('master.master')
@section('content')
    <div class="container my-4 p-4">

        @if(session('message'))
        <div id="success-alert" class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <div class="row justify-content-center">
            <!-- Coluna de Informações do Funcionário -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <div class="text-center mb-4">
                            <div class="text-center my-2"><img
                                    src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="logo"
                                    width="150"></div>
                            <hr>

                            <div class="mb-1">
                                <img width="70px" height="70px"
                                    src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/defaultUser.png') }}"
                                    alt="" style="border-radius:50%"></td>

                            </div>
                            <h3 class="card-title mb-3">{{ Auth::user()->name }}</h3>
                            <p class="card-text text-muted">Estas são as informações da sua conta:</p>
                        </div>
                        <div class="container">
                            <div
                                class="d-flex flex-column flex-md-row p-4 gap-4 py-md-3 align-items-center justify-content-center">
                                <div class="list-group w-75">
                                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                                        aria-current="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                        </svg>
                                        <div class="d-flex gap-2 w-100 justify-content-between">
                                            <div>
                                                <h5 class="mb-0">Email</h5>
                                                <p class="mb-0 opacity-75">{{ Auth::user()->email }}</p>
                                            </div>

                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                                        aria-current="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                        </svg>
                                        <div class="d-flex gap-2 w-100 justify-content-between">
                                            <div>
                                                <h5 class="mb-0">Setor</h5>
                                                <p class="mb-0 opacity-75">{{ Auth::user()->setor }}</p>
                                            </div>

                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                                        aria-current="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                            <path
                                                d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                            <path
                                                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                        </svg>
                                        <div class="d-flex gap-2 w-100 justify-content-between">
                                            <div>
                                                <h5 class="mb-0">Tipo de conta</h5>
                                                @if (Auth::user()->user_type_id == 1)
                                                    <p class="mb-0 opacity-75">Admin</p>
                                                @else
                                                    <p class="mb-0 opacity-75">Funcionário</p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                    <button class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#solicitacaoSenhaModal">
                                    Solicitar Alteração de Senha
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal de Solicitação de Alteração de Senha -->
            <div class="modal fade" id="solicitacaoSenhaModal" tabindex="-1" aria-labelledby="solicitacaoSenhaModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="solicitacaoSenhaModalLabel">Solicitar Alteração de Senha</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem certeza de que deseja solicitar a alteração da sua senha? Essa solicitação será enviada
                                ao administrador, que fará a alteração.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>

                            <!-- Formulário para enviar solicitação ao servidor -->
                            <form action="{{ route('user.password') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark">Confirmar Solicitação</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
