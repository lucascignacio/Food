@extends('adminlte::page')

@section('title', "Detalhes do usuário $user->name")

@section('content_header')
    <h1> Detalhes do plano <b>{{ $user->name }}</b></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
                <li>
                    <strong>E-mail: </strong> {{ $user->email }}
                </li>
                <li>
                    <strong>Empresa: </strong> {{ $user->tenant->name }}
                </li>
            </ul>

            <form action="{{ route('users.destroy', $user->id )}}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR O USUÁRIO {{ $user->name }}</button>
            </form>
        </div>
    </div>
@endsection