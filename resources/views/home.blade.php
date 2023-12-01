@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>


                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <button id="create-user-btn" class="btn btn-success">Criar Usuário</button><br><br>

                    <div id="create-user-modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Criar Usuário</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span><span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form id="create-user-form" method="POST" action="{{ route('users.store') }}">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nome:</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Senha:</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Editar Usuário</h1>
                                    <button type="button" class="close" id="fecharIconeEditar" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Fechar">×</button>
                                </div>
                                <form id="formEdit">
                                    @csrf
                                    <input type="hidden" id="id" name="id" />
                                    <div class="modal-body">
                                        <div>
                                            <div class="form-group">
                                                <label for="name">Id:</label>
                                                <input type="text" class="form-control" id="idEdit" name="id" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Nome:</label>
                                                <input type="text" class="form-control" id="nameEdit" name="name" placeholder="Digite seu nome">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" id="emailEdit" name="email" placeholder="Digite seu email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="fecharEditar" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Fechar</button>
                                        <button id="save" type="submit" class="btn btn-primary">Salvar Usuario</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table id="list-users" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Funções</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"></script>


@endsection