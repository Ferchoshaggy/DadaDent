@extends('adminlte::page')

@section('title', 'Presupuesto')

@section('content_header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@section('content')
<br>
<div class="card">
    <div class="card-body">

  <div class="row">
    <div class="col-6">
   <h3>Presupuesto</h3>
  </div>
  <div class="col-6">
    <button class="btn btn btn-warning" style="width: 20%;float: right;">Nuevo</button>
  </div>
</div>
<br>

<div class="table-responsive">
    <table class="table" style="width: 100%">
        <thead class="thead-light">
          <tr>
            <th style="text-align: center;">Paciente</th>
            <th style="text-align: center;">Edad</th>
            <th style="text-align: center;">Importe</th>
            <th style="text-align: center;">Costo a publico</th>
            <th style="text-align: center;">Por. de ganancias</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>

</div>

    </div>
</div>

@stop

@section('css')

@stop

@section('js')

<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<script>
    //funcion de la tabla de boostrap tenga paginador y buscador
  $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });
  });
</script>

@stop
