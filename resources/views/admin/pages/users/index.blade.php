@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Usuarios</a></li>
    </ol>

    <h1>Usuarios <a href="{{route('users.create')}}" class="btn btn-dark">ADD</a></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th width="270">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td style="width: 10px;">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!} 
            @else 
                {!! $users->links() !!}
            @endif
        </div>
    </div>
@endsection