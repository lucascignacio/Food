@extends('adminlte::page')

@section('title', 'Cadastrar Nova Mesa')

@section('content_header')
    <h1> Cadastrar Nova Mesa</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" class="form" method="POST">
                @csrf

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Identificação:</label>
                    <input type="text" name="identify" class="form-control" placeholder="Identificação:">
                </div>
                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="description" id="" cols="30" rows="5" placeholder="Descriçao:" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection