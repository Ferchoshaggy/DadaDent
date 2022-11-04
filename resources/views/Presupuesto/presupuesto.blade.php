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
    <button class="btn btn btn-warning" style="width: 15%;float: right;" data-toggle="modal" data-target="#nuevoPre">Nuevo</button>
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

<!-- Modal -->
<div class="modal fade" id="nuevoPre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Presupuesto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
            @csrf
        <div class="modal-body">

<div class="row">
    <div class="col-md-12">
<input type="text" name="nombre" id="nombre" class="form-control" style="border-color: orange" placeholder="Nombre del Paciente">
    </div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<select name="sexo" id="sexo" style="background:orange;color:white" class="form-control">
    <option selected disabled>Sexo</option>
</select>
</div>
<div class="col-md-4">
    <select name="tipo" id="tipo" style="background:orange;color:white" class="form-control">
        <option selected disabled>Tipo</option>
    </select>
</div>
<div class="col-md-4">
<input type="number" name="edad" id="edad" style="border-color: orange" class="form-control" placeholder="Edad">
</div>
</div>
<br>

<div class="row">
    <div class="col-md-3">
<input type="number" name="importe_to" id="importe_to" style="border-color: orange" class="form-control" placeholder="Importe total" readonly>
    </div>
    <div class="col-md-3">
<input type="number" name="costo_pu" id="costo_pu" style="border-color: orange" class="form-control" placeholder="Costo a publico total" readonly>
    </div>
    <div class="col-md-3">
<input type="number" name="ganancia_to" id="ganancia_to" style="border-color: orange" class="form-control" placeholder="Ganancia total" readonly>
    </div>
    <div class="col-md-3">
<input type="number" name="porcentaje_ga" id="porcentaje_ga" style="border-color: orange" class="form-control" placeholder="Por. de ganancia total" readonly>
    </div>
    </div>
<br>

<div style="background: rgb(23 24 24 / 53%); border-radius:10px">
<label for="lista" style="color: #fff; margin-left: 10px;">Procedimientos</label>
</div>
<br><br>

<textarea name="observacion" id="observacion" class="form-control" style="border-color: orange" placeholder="Observaciones" rows="2"></textarea>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button class="btn butt">Agregar</button>
        </div>
    </form>
      </div>
    </div>
  </div>


    </div>
</div>

@stop

@section('css')
<style>
        input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] { -moz-appearance:textfield; }
.butt{

        border-radius:10px;
        color:white;
        background:rgba(255, 166, 0, 0.986);
    }
    .marca{
        transition: 1s;
    }
    .marca:hover{
        background: #797d8b80;
        transition: 1s;
    }
    .visible_on{
        display: block;
        position: fixed;
        background: white;
        border-radius: 15px;
        width: auto;
    }
    .visible_off{
        display: none;
    }
    .paginate_button{
    position:sticky;
}
</style>
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
