@extends('adminlte::page')

@section('title', "Editar o Produto {$product->title}")

@section('content_header')
    <h1> Editar o Produto {{ $product->title }} </h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.includes.alerts')

                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" class="form-control" placeholder="Title:" value="{{ $product->title ?? old('title') }}" >
                </div>
                <div class="form-group">
                    <label>Preço:</label>
                    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price') }}" >
                </div>
                <div class="form-group">
                    <label>Imagem:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>description:</label>
                   <textarea name="description" cols="30" rows="5" class="form-control">{{ $product->description ?? old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Atualizar os dados</button>
                </div>
            </form>
        </div>
    </div>
@endsection