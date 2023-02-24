@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
    <h1> Cadastrar Novo Perfil</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" class="form" method="POST">
                @csrf

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:">
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection