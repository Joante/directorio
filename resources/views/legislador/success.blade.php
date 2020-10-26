@extends('layouts.app')

@section('content')
@include('users.partials.header', [
        'title' => ' ',
        'description' => ' '
    ])
    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-lg-8 card-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h3 mb-0">Carga Exitosa</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-4">La carga del nuevo legislador fue exitosa. Para poder ver todos los legisladores ingresados por favor ingresar al sistema.</p>
                        <a href="{{route('login')}}" class="btn btn-primary">Iniciar Sesion</a>
                        <hr>
                        <a href="{{route('legislador.create')}}" class="btn btn-primary">Cargar nuevo legislador</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
