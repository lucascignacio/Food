@extends('adminlte::page')

@section('name', "Detalhes da Empresa $tenant->name")

@section('content_header')
    <h1> Detalhes do Empresa <b>{{ $tenant->name }}</b></h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" style="max-width: 90px;">
            <ul>
                <li>
                    <strong>Plano: </strong> {{ $tenant->plan->name }}
                </li>
                <li>
                    <strong>Nome: </strong> {{ $tenant->name }}
                </li>
                <li>
                    <strong>URl: </strong> {{ $tenant->url }}
                </li>
                <li>
                    <strong>CNPJ: </strong> {{ $tenant->cnpj }}
                </li>
                <li>
                    <strong>Ativo: </strong> {{ $tenant->subscription_active == 'Y' ? 'SIM' : 'NÃO'}} 
                </li>
            </ul>

            <hr>
            <h3>Assinatura</h3>
            <ul>
                <li>
                    <strong>Data Assinatura: </strong> {{ $tenant->subscription }}
                </li>
                <li>
                    <strong>Data Expria: </strong> {{ $tenant->expires_at }}
                </li>
                <li>
                    <strong>Identificador :</strong> {{ $tenant->subscription_id }}
                </li> 
                <li>
                    <strong>Ativo: </strong> {{ $tenant->subscription_active ? 'SIM' : 'NÃO'}} 
                </li>
                <li>
                    <strong>Cancelou? </strong> {{ $tenant->subscription_suspended ? 'SIM' : 'NÃO'}} 
                </li>
            </ul>
        </div>
    </div>
@endsection