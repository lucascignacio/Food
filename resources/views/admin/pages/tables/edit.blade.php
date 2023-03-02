@extends('adminlte::page')

@section('title', "Editar a Mesa $table->identify")

@section('content_header')
    <h1> Editar a Mesa {{ $table->identify }} </h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Identificação:</label>
                    <input type="text" name="identify" class="form-control" placeholder="Identificação:" value="{{ $table->identify ?? old('name') }}" >
                </div>
                <div class="form-group">
                    <label>Descrição:</label>
                   <textarea name="description" cols="30" rows="5" class="form-control">{{ $table->description ?? old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Atualizar os dados</button>
                </div>
            </form>
        </div>
    </div>
@endsection