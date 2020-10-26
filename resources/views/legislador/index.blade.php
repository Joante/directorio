@extends('layouts.app')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/sweetalert2.min.css') }}">
@endsection
@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="card" style="width:100%;">
        <div class="card-header">
          <h4 class="card-title">Filtros</h4>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <div class="users-list-filter">
              <form method="POST" action="/legisladores/filter" id="filter_form">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3">
                    <label for="uuid">ID</label>
                    <fieldset class="form-group">
                        <input type="text" id="id" name="id" class="form-control" placeholder="Buscar...">
                        @if ($errors->has('id'))
                            <div class="alert alert-danger" role="alert">
                                <p class="mb-0">
                                    {{$errors->first('id') }}
                                </p>
                            </div>
                        @endif
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="date_from">Inicio Mandato</label>
                    <fieldset class="form-group">
                        <input type="date" id="date_from" name="date_from" class="form-control" placeholder="Desde...">
                        @if ($errors->has('date_from'))
                            <div class="alert alert-danger" role="alert">
                                <p class="mb-0">
                                    {{$errors->first('date_from') }}
                                </p>
                            </div>
                        @endif
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="date_to">Fin Mandato</label>
                    <fieldset class="form-group">
                        <input type="date" name="date_to" class="form-control" placeholder="Hasta...">
                        @if ($errors->has('date_to'))
                            <div class="alert alert-danger" role="alert">
                                <p class="mb-0">
                                    {{$errors->first('date_to') }}
                                </p>
                            </div>
                        @endif
                    </fieldset>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-3">
                    <label for="party">Partido Politico</label>
                    <fieldset class="form-group">
                      <select class="form-control" id="part" name="party">
                        <option value="">Todos</option>
                        <option value="Azul">Azul</option>
                        <option value="Rojo">Rojo</option>
                        <option value="Verde">Verde</option>
                      </select>
                      @if ($errors->has('party'))
                            <div class="alert alert-danger" role="alert">
                                <p class="mb-0">
                                    {{$errors->first('party') }}
                                </p>
                            </div>
                        @endif
                    </fieldset>
                  </div>
                  
                </div>
                <button id="form_button" type="submit" class="btn btn-primary mr-1 mb-1">Buscar</button>
                <button id="reset_button" type="reset" class="btn btn-primary mr-1 mb-1">Limpiar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Legisladores</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-flush dataTable" id="datatable-basic">
                                        <thead class="thead-light">
                                            <tr role="row">
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Email</th>
                                                <th>Partido Politico</th>
                                                <th>Votos Obtenidos</th>
                                                <th>Inicio Mandato</th>
                                                <th>Fin Mandato</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/components/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/components/sweerAlertDeleteConfirmation.js') }}"></script>
    <script>
        var table = $('#datatable-basic').DataTable({
            processing: true,
            serverSide: true,
            search: false,
            bFilter: false,
            sDom: 'lrtip',
            order: [ 0, 'asc' ],
            pagingType: "simple_numbers",
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "language":
                {
                    "sProcessing" :     "Procesando...",
                    "sLengthMenu" :     "Mostrar _MENU_ registros",
                    "sZeroRecords" :    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst" :    "Primero",
                        "sLast" :     "Último",
                        "sNext" :     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    },
                    "partido_politico" : "Partido Politico",
                    'mandato_inicio': 'Inicio Mandato',
                    'mandato_fin': 'Fin Mandato',
                    'votos_obtenidos': 'Votos Obtenidos'
                },
            ajax: "/legisladores",
            columns: [
                {data: 'id', name: 'ID'},
                {data: 'nombre', name: 'Nombre'},
                {data: 'apellido', name:'Apellido'},
                {data: 'email', name: 'Email'},
                {data: 'partido_politico', name: 'partido_politico'},
                {data: 'votos_obtenidos', name: 'Votos_obtenidos'},
                {data: 'mandato_inicio', name: 'mandato_inicio'},
                {data: 'mandato_fin', name: 'mandato_fin'},
                {data:null, render: function(data,type, row, meta){
                    var editButton ='<a href="/legisladores/'+row['id']+'/edit"><button class="btn btn-icon btn-outline-warning"><i class="far fa-edit"></i></button></a>';
                    var deleteButton = '<meta name="csrf-token" content="{{ csrf_token() }}"><button class="btn btn-icon btn-outline-danger" onclick="deleteConfirmation(`'+row['id']+'`,`legisladores`)"><i class="far fa-trash-alt"></i></button>';
                    var viewButton = '<a href="/legisladores/'+row['id']+'"><button class="btn btn-icon btn-outline-info"><i class="fas fa-search"></i></button></a>';
                    return viewButton+editButton+deleteButton;
                }}
            ]
        });

        $("#filter_form").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serializeArray();
            var postData = new Array;
            formData.forEach(element => {
                if(element.value != "" && element.name != "_token")
                {
                    postData.push(element);
                }
        });

    $.ajax({
        type: "post",
        url: "/legisladores/filter",
        data: JSON.stringify({postData}),
        headers: { 'X-CSRF-TOKEN': formData[0].value },
        contentType: "application/json",
        success: function(responseData, textStatus, jqXHR) {
            filterTable(responseData);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    })
    //Creamos una nueva tabla con los datos filtramos y destruimos la anterior
    function filterTable(data)
    {
        var table = $('#datatable-basic').DataTable();
        table.destroy();
        $('#datatable-basic').empty();

        var createTable = document.getElementById('datatable-basic');
        var thead = document.createElement('thead');
        var tr = document.createElement('tr');
        var th1 = document.createElement('th');
        th1.innerText = "ID";
        var th2 = document.createElement('th');
        th2.innerText = "Nombre";
        var th3 = document.createElement('th');
        th3.innerText = "Apellido";
        var th4 = document.createElement('th');
        th4.innerText = "Email";
        var th5 = document.createElement('th');
        th5.innerText = "Partido Politico";
        var th6 = document.createElement('th');
        th6.innerText = "Votos Obtenidos";
        var th7 = document.createElement('th');
        th7.innerText = "Inicio Mandato";
        var th8 = document.createElement('th');
        th1.innerText = "Fin Mandato";
        var th9 = document.createElement('th');
        th1.innerText = "Acciones";
        tr.appendChild(th1);
        tr.appendChild(th2);
        tr.appendChild(th3);
        tr.appendChild(th4);
        tr.appendChild(th5);
        tr.appendChild(th6);
        tr.appendChild(th7);
        tr.appendChild(th8);
        tr.appendChild(th9);
        thead.appendChild(tr);
        createTable.appendChild(thead);
        var filterTable = $('#datatable-basic').DataTable( {
            data:data.data,
            search: false,
            bFilter: false,
            sDom: 'lrtip',
            order: [ 0, 'asc' ],
            pagingType: "simple_numbers",
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "language": {
                "sProcessing" :     "Procesando...",
                "sLengthMenu" :     "Mostrar _MENU_ registros",
                "sZeroRecords" :    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst" :    "Primero",
                    "sLast" :     "Último",
                    "sNext" :     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                },
                    "partido_politico" : "Partido Politico",
                    'mandato_inicio': 'Inicio Mandato',
                    'mandato_fin': 'Fin Mandato',
                    'votos_obtenidos': 'Votos Obtenidos'
                },
            columns: [
                {data: 'id', name: 'ID'},
                {data: 'nombre', name: 'Nombre'},
                {data: 'apellido', name:'Apellido'},
                {data: 'email', name: 'Email'},
                {data: 'partido_politico', name: 'partido_politico'},
                {data: 'votos_obtenidos', name: 'Votos_obtenidos'},
                {data: 'mandato_inicio', name: 'mandato_inicio'},
                {data: 'mandato_fin', name: 'mandato_fin'},
                {data:null, render: function(data,type, row, meta){
                    var editButton ='<a href="/legisladores/'+row['id']+'/edit"><button class="btn btn-icon btn-outline-warning"><i class="far fa-edit"></i></button></a>';
                    var deleteButton = '<meta name="csrf-token" content="{{ csrf_token() }}"><button class="btn btn-icon btn-outline-danger" onclick="deleteConfirmation(`'+row['id']+'`,`legisladores`)"><i class="far fa-trash-alt"></i></button>';
                    var viewButton = '<a href="/legisladores/'+row['id']+'"><button class="btn btn-icon btn-outline-info"><i class="fas fa-search"></i></button></a>';
                    return viewButton+editButton+deleteButton;
                }}
            ]
        } );
    }
    });
    </script>
@endpush
