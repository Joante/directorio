@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-lg-8 card-wrapper4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0">Bienvenido!</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Bienvenido {{Auth::user()->name}} aqui podra ver, editar y borrar los legisladores cargados.</p>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection

