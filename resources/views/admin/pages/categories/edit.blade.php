@extends('adminlte::page')

@section('title', "Editar a Categoria {$category->name}")

@section('content_header')
    <h1> Editar a Categoria {{ $category->name }} </h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $category->name ?? old('name') }}" >
                </div>
                <div class="form-group">
                    <label>description:</label>
                   <textarea name="description" cols="30" rows="5" class="form-control">{{ $category->description ?? old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Atualizar os dados</button>
                </div>
            </form>
        </div>
    </div>
@endsection