@extends('adminlte::page')

@section('title', "Detalhes da Produto $product->title")

@section('content_header')
    <h1> Detalhes do Produto <b>{{ $product->title }}</b></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 90px;">
            <ul>
                <li>
                    <strong>Title: </strong> {{ $product->title }}
                </li>
                <li>
                    <strong>Preço: </strong> {{ $product->price }}
                </li>
                <li>
                    <strong>Flag: </strong> {{ $product->flag }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
            </ul>

            <form action="{{ route('products.destroy', $product->id )}}" method="POST">
                @csrf 
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR A Produto {{ $product->name }}</button>
            </form>
        </div>
    </div>
@endsection