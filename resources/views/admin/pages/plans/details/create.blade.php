@extends('adminlte::page')

@section('title', "Adicionar novo detalhe ao plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.create', $plan->url) }}" class="active">Novo</a></li>
    </ol>

    <h1>Adicionar novo detalhe ao plano {{ $plan->name }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            
            @include('admin.includes.alerts')

            <form action="{{ route('details.plan.store', $plan->url) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nome:</label> 
                    <input type="text" name="name" placeholder="Nome" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection