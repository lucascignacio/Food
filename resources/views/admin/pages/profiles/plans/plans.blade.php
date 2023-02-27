@extends('adminlte::page')

@section('title', "Planos da perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.plans') }}">Planos</a></li>
    </ol>

    <h1> Planos da perfil <strong>{{ $profile->name }} </strong></h1>
    
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>
                                {{$plan->name}}
                            </td>
                            <td style="width: 10px;">
                                <a href="{{ route('plans.profile.detach', [$plan->id, $plan->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else 
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@endsection