@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <h1> Cadastrar Nova Categoria</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>* Title:</label>
                    <input type="text" name="title" class="form-control" placeholder="Title:">
                </div>
                <div class="form-group">
                    <label>* Preço:</label>
                    <input type="text" name="price" class="form-control" placeholder="Price:">
                </div>
                <div class="form-group">
                    <label>* Imagem:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>* Descrição:</label>
                    <textarea name="description" id="" cols="30" rows="5" placeholder="Descriçao:" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection