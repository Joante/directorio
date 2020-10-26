@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Cargar Nuevo Legislador'),
        'description' => __('En esta pagina se puede cargar un nuevo legislador')
    ])
    <div class="container-fluid mt--7">
        <div class="row justify-content-md-center">
            <div class="container-fluid mt--6">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">Nuevo Legislador</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('legislador.store') }}">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Informacion Personal</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">Nombre</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-last_name">Apellido</label>
                                        <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="Apellido" value="{{ old('last_name') }}" required autofocus>

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-phone">Telefono</label>
                                        <input type="tel" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Telefono" value="{{ old('phone') }}" required>

                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('adress') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-adress">Direccion</label>
                                        <input type="text" name="adress" id="input-adress" class="form-control form-control-alternative{{ $errors->has('adress') ? ' is-invalid' : '' }}" placeholder="Direccion" value="{{ old('adress') }}" autofocus>

                                        @if ($errors->has('adress'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('adress') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="select-pais">Pais</label>
                                        <select class="form-control" id="select-pais" name="country">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <h6 class="heading-small text-muted mb-4">Informacion Politica</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('votes') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-votes">Cantidad de votos obtenidos</label>
                                        <input type="number" name="votes" id="input-votes" class="form-control form-control-alternative{{ $errors->has('votes') ? ' is-invalid' : '' }}" placeholder="Cantidad de votos obtenidos" value="{{ old('votes') }}" required>

                                        @if ($errors->has('votes'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('votes') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('party') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-party">Partido Politico</label>
                                        <select class="form-control" id="select-party" name="party">
                                            <option value="">Seleccionar partido politico</option>
                                            <option value="Azul">Azul</option>
                                            <option value="Rojo">Rojo</option>
                                            <option value="Verde">Verde</option>
                                        </select>

                                        @if ($errors->has('party'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('party') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-start">Inicio de mandato</label>
                                        <input type="date" name="start" id="input-start" class="form-control form-control-alternative{{ $errors->has('start') ? ' is-invalid' : '' }}" placeholder="Inicio de mandato" value="{{ old('start') }}" required>

                                        @if ($errors->has('start'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('start') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-end">Fin de mandato</label>
                                        <input type="text" name="end" id="input-end" class="form-control form-control-alternative{{ $errors->has('end') ? ' is-invalid' : '' }}" placeholder="dd/mm/aaaa" value="{{ old('end')}}" required readonly>

                                        @if ($errors->has('end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $( document ).ready(function() {
        var select = document.getElementById('select-pais');
        let url = 'https://restcountries.eu/rest/v2/all'
            fetch(url)
            .then(function(response) {
                return response.json();
            })
            .then(function(myJson) {
                myJson.forEach(item => {
                    var paisOption = document.createElement("option");
                    paisOption.className = 'pais_option'
                    paisOption.value = item.name
                    paisOption.text = item.name
                    select.prepend(paisOption)
                })
            });
        });
        var startDate = document.getElementById('input-start');

        startDate.onchange = function(e){
            var date = startDate.value.split("-");
            var year = parseInt(date[0])+1;
            var endDate = date[2]+"/"+date[1]+"/"+year.toString();
            var inputEnd = document.getElementById('input-end');
            $("#input-end").removeAttr("readonly");
            inputEnd.value = endDate;
            $("#input-end").attr("readonly","readonly");
        };
    </script>
@endpush

