@extends('adminlte::page')

@section('title', "Detalhes da Mesa $table->identify")

@section('content_header')
    <h1> Detalhes do Mesa <b>{{ $table->identify }}</b></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Identificador da mesa: </strong> {{ $table->identify }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $table->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('tables.destroy', $table->id )}}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR A MESA {{ $table->name }}</button>
            </form>
        </div>
    </div>
@endsection