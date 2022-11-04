@extends('adminlte::page')

@section('title', 'Procedimientos')

@section('content_header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@section('content')
<br>
<div class="card">
    <div class="card-body">


        <div class="row">
            <div class="col-12">
           <h3>Procedimientos</h3>
          </div>
          </div>

          <div class="row">
          <div class="col-12">
            <button class="btn butt" style="width: 15%;float: right;" data-toggle="modal" data-target="#agregarProce">Agregar</button>
          </div>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th style="text-align: center;">Nombre</th>
                    <th style="text-align: center;">Costo</th>
                    <th style="text-align: center;">Costo a publico</th>
                    <th style="text-align: center;">No.materiales</th>
                    <th style="text-align: center;">Porcentaje de ganancia</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
        </div>

 <!-- Modal -->
<div class="modal fade" id="agregarProce" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar un Nuevo Procedimiento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
            @csrf
        <div class="modal-body">

<div class="row">
    <div class="col-md-12">
<input type="text" name="nombre" class="form-control" style="border-color: orange" placeholder="Nombre">
    </div>
</div>
<br>

<div class="row">
<div class="col-md-4">
<input type="number" class="form-control" placeholder="Costo" name="costo" id="costo" readonly style="border-color: orange">
</div>
<div class="col-md-4">
<input type="number" name="costo_public" id="costo_public" class="form-control" placeholder="Costo a Publico" style="border-color: orange">
</div>
<div class="col-md-4">
<input type="number" name="porcentaje" id="porcentaje" class="form-control" placeholder="Porcentaje de Ganancia" readonly style="border-color: orange">
</div>
</div>
<br>
<div style="background: rgb(23 24 24 / 53%); border-radius:10px">
<label for="lista" style="color: #fff; margin-left: 10px;">Lista de Materiales</label>
</div>


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
