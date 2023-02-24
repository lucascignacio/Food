@extends('adminlte::page')

@section('title', "Editar a Permissão {$permission->name}")

@section('content_header')
    <h1> Editar a Permissão {{ $permission->name }} </h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $permission->name ?? old('name') }}" >
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $permission->description ?? old('description') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Atualizar os dados</button>
                </div>
            </form>
        </div>
    </div>
@endsection