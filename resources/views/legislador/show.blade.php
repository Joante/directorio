@extends('layouts.app')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/components/sweetalert2.min.css') }}">
@endsection
@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row justify-content-md-center">
            <!-- account start -->
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                    <h3 class="mb-0">{{$legislador->nombre}} {{$legislador->apellido}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">Nombre: </span>
                                <span>{{$legislador->nombre}}</span>
                            </div>
                            <div class="col">
                                <span class="font-weight-bold">Apellido: </span>
                                <span>{{$legislador->apellido}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">Email: </span>
                                <span>{{$legislador->email}}</span>
                            </div>
                            <div class="col">
                                <span class="font-weight-bold">Telefono: </span>
                                <span>{{$legislador->telefono}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">Direccion: </span>
                                <span>{{$legislador->direccion}}</span>
                            </div>
                            <div class="col">
                                <span class="font-weight-bold">Pais: </span>
                                <span>{{$legislador->pais}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">Votos Obtenidos: </span>
                                <span>{{$legislador->votos_obtenidos}}</span>
                            </div>
                            <div class="col">
                                <span class="font-weight-bold">Partido Politico: </span>
                                <span>{{$legislador->partido_politico}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">Inicio de Mandato: </span>
                                <span>{{$legislador->mandato_inicio}}</span>
                            </div>
                            <div class="col">
                                <span class="font-weight-bold">Fin de Mandato: </span>
                                <span>{{$legislador->mandato_fin}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold">Automatico: </span>
                                @if($legislador->automatico == null || $legislador->automatico == false)
                                    <span><i class="fas fa-toggle-off"></i></span>
                                @elseif($legislador->automatico)
                                    <span><i class="fas fa-toggle-on"></i></span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="/legisladores/{{$legislador->id}}/edit" class="btn btn-success mt-4">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.footers.auth')
    </div>
@endsection
