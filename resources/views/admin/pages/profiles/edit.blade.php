@extends('adminlte::page')

@section('title', "Editar o Perfil {$profile->name}")

@section('content_header')
    <h1> Editar o Perfil {{ $profile->name }} </h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $profile->name ?? old('name') }}" >
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $profile->description ?? old('description') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Atualizar os dados</button>
                </div>
            </form>
        </div>
    </div>
@endsection