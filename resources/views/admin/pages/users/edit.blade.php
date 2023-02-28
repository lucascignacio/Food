@extends('adminlte::page')

@section('title', "Editar o usuário {$user->name}")

@section('content_header')
    <h1> Editar o usuário {{ $user->name }} </h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}" >
                </div>
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="text" name="email" class="form-control" placeholder="E-mail:" value="{{ $user->email ?? old('email') }}">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Password:">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Atualizar os dados</button>
                </div>
            </form>
        </div>
    </div>
@endsection