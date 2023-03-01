@extends('adminlte::page')

@section('title', "Detalhes da Categoria $category->name")

@section('content_header')
    <h1> Detalhes do Categoria <b>{{ $category->name }}</b></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $category->description }}
                </li>
            </ul>

            <form action="{{ route('categories.destroy', $category->id )}}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR A CATEGORIA {{ $category->name }}</button>
            </form>
        </div>
    </div>
@endsection