@extends('adminlte::page')

@section('title', 'Categorias disponíveis para o produto $product->title')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}">Categorias</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories.available', $product->id) }}" class="active">disponíveis</a></li>
    </ol>

    <h1> Categorias disponíveis para o produto <strong>{{ $product->title }} </strong></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.categories.available', $product->id) }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <form action="{{ route('products.categories.attache', $product->id) }}" method="POST">
                    @csrf
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            </td>
                            <td>
                                {{$category->name}}
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts')

                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </tbody>
                </form>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else 
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@endsection