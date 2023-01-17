@extends('adminlte::page')

@section('title', 'Presupuesto')

@section('content_header')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
<br>
<div class="card">
    <div class="card-body">

@if (Session::has('message'))
<br>

@if(Session::get('message')== "Se Guardo Correctamente el Presupuesto")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Session::get('message')== "Se Actualizo Correctamente el Presupuesto")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Session::get('message')== "Se Elimino Correctamente el Presupuesto")
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-family: Arial, Helvetica, sans-serif;">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@endif

        <div class="row">
            <div class="col-12">
               <h3>Presupuesto</h3>
            </div>
            <div class="col-12" style="text-align: right;">
                <button class="btn butt " data-toggle="modal" data-target="#nuevoPre" onclick="activar_select2();">Nuevo</button>
            </div>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th style="text-align: center;">Paciente</th>
                    <th style="text-align: center;">Edad</th>
                    <th style="text-align: center;">Inversión</th>
                    <th style="text-align: center;">Costo a publico</th>
                    <th style="text-align: center;">Por. de ganancias</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($presupuestos as $presupuesto)
                    <tr class="marca" onclick="pasar_id({{$presupuesto->id}});">
                        <td style="text-align: center;">{{$presupuesto->nombre}}</td>
                        <td style="text-align: center;">{{$presupuesto->edad}}</td>
                        <td style="text-align: center;">${{$presupuesto->invercion}}</td>
                        <td style="text-align: center;">${{$presupuesto->costo_publico}}</td>
                        <td style="text-align: center;">{{$presupuesto->porcentaje}}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

        </div>



    </div>
</div>

<!-- Modal agregar-->
<div class="modal fade" id="nuevoPre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Presupuesto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{url('/save_presupuesto')}}" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Nombre del Paciente</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" style="border-color: #D6802E" placeholder="Nombre del Paciente">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Sexo</label>
                        <select name="sexo" id="sexo" style="background-color:#D6802E;color:white" class="form-control flechita">
                             <option selected disabled value="" style="background-color: #fff; color: black;">.:selecciona:.</option>
                             @foreach($generos as $genero)
                             <option value="{{$genero->id}}" style="background-color: #fff; color: black;">{{$genero->sexo}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Tipo</label>
                        <select name="tipo" id="tipo" style="background-color:#D6802E;color:white" class="form-control flechita" onchange="reinicio_dientes();">
                            <option selected disabled value="" style="background-color: #fff; color: black;">.:selecciona:.</option>
                            @foreach($tipos as $tipo)
                             <option value="{{$tipo->id}}" style="background-color: #fff; color: black;">{{$tipo->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Edad</label>
                        <input type="number" name="edad" id="edad" style="border-color: #D6802E" class="form-control" placeholder="Edad" min="1">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label>Inversión total</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" name="importe_to" id="importe_to" style="border-color: #D6802E" class="form-control" placeholder="Inverción total" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Costo a publico total</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" name="costo_pu" id="costo_pu" style="border-color: #D6802E" class="form-control" placeholder="Costo a publico total" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label >Utilidad total</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" name="utilidad" id="utilidad" style="border-color: #D6802E" class="form-control" placeholder="Utilidad total" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Por. de ganancia total</label>
                        <input type="text" name="porcentaje_ga" id="porcentaje_ga" style="border-color: #D6802E" class="form-control" placeholder="Por. de ganancia total" readonly>
                    </div>
                </div>
                <br>

                <div style="background-color: #D9D9D9; border-radius:10px">
                    <label for="lista" style=" margin-left: 10px;">Procedimientos</label>
                    <div  style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <label >Ubicacion</label>
                                <select class=" form-control flechita" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="ubicacion0" id="ubicacion0" onchange="agregar_dientes(0);" required>
                                    <option disabled value="" selected style="background-color: #fff; color: black;">.:selecciona:.</option>
                                    @foreach($ubicacions as $ubicacion)
                                     <option value="{{$ubicacion->id}}" style="background-color: #fff; color: black;">{{$ubicacion->ubicacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Pz. Dental</label>
                                <select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="pz0" id="pz0" onchange="" required >
                                    <option disabled value="" selected>.:selecciona:.</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 20px;">
                                <label>Procedimiento</label>
                                <select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="procedimiento0" id="procedimiento0" onchange="sacar_costos(this);" required data-costo="" data-costo_publico="">
                                    <option disabled value="" selected >.:selecciona:.</option>
                                    @foreach($procedimientos as $procedimiento)
                                     <option value="{{$procedimiento->id}}" style="background-color: #fff; color: black;">{{$procedimiento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 20px;">
                                <label >Descuento</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text" style="border-color: #D6802E;">%</span>
                                  <input type="number" class="form-control" name="descuento0" id="descuento0" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" placeholder="Descuento" onkeyup="resultados();" onchange="resultados();">
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <button type="button" class="btn" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; background-color: #2FB4D6; color: #fff; word-wrap: break-word;" onclick="mas_procedimientos();">Agregar</button>
                            </div>
                        </div>

                        <div id="listado_padre" style="overflow-y: auto; overflow-x: hidden; width: 100%; max-height: 300px;" class="multiple">
                            
                        </div>

                    </div>
                </div>
                <br><br>
                <label>Observaciones</label>
                <textarea name="observacion" id="observacion" class="form-control" style="border-color: #D6802E" placeholder="Observaciones" rows="2"></textarea>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="numero_de_procedimientos" id="numero_de_procedimientos" value="0">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button class="btn butt">Agregar</button>
            </div>
        </form>
      </div>
    </div>
</div>


<!-- Modal agregar editar-->
<div class="modal fade" id="editarPre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Presupuesto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form action="{{url('/update_presupuesto')}}" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Nombre del Paciente</label>
                        <input type="text" name="nombre_edit" id="nombre_edit" class="form-control" style="border-color: #D6802E" placeholder="Nombre del Paciente">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Sexo</label>
                        <select name="sexo_edit" id="sexo_edit" style="background-color:#D6802E;color:white" class="form-control flechita">
                             <option selected disabled value="" style="background-color: #fff; color: black;">.:selecciona:.</option>
                             @foreach($generos as $genero)
                             <option value="{{$genero->id}}" style="background-color: #fff; color: black;">{{$genero->sexo}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Tipo</label>
                        <select name="tipo_edit" id="tipo_edit" style="background-color:#D6802E;color:white" class="form-control flechita" onchange="reinicio_dientes_edit();">
                            <option selected disabled value="" style="background-color: #fff; color: black;">.:selecciona:.</option>
                            @foreach($tipos as $tipo)
                             <option value="{{$tipo->id}}" style="background-color: #fff; color: black;">{{$tipo->tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label>Edad</label>
                        <input type="number" name="edad_edit" id="edad_edit" style="border-color: #D6802E" class="form-control" placeholder="Edad" min="1">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label>Inversión total</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" name="importe_to_edit" id="importe_to_edit" style="border-color: #D6802E" class="form-control" placeholder="Inverción total" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Costo a publico total</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" name="costo_pu_edit" id="costo_pu_edit" style="border-color: #D6802E" class="form-control" placeholder="Costo a publico total" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label >Utilidad total</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text" style="border-color: #D6802E;">$</span>
                          <input type="number" name="utilidad_edit" id="utilidad_edit" style="border-color: #D6802E" class="form-control" placeholder="Utilidad total" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 20px;">
                        <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Por. de ganancia total</label>
                        <input type="text" name="porcentaje_ga_edit" id="porcentaje_ga_edit" style="border-color: #D6802E" class="form-control" placeholder="Por. de ganancia total" readonly>
                    </div>
                </div>
                <br>

                <div style="background-color: #D9D9D9; border-radius:10px">
                    <label for="lista" style=" margin-left: 10px;">Procedimientos</label>
                    <div  style="padding: 20px;">

                        <div class="row">
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <label >Ubicacion</label>
                                <select class=" form-control flechita" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="ubicacion_edit0" id="ubicacion_edit0" onchange="agregar_dientes_edit(0);" required>
                                    <option disabled value="" selected style="background-color: #fff; color: black;">.:selecciona:.</option>
                                    @foreach($ubicacions as $ubicacion)
                                     <option value="{{$ubicacion->id}}" style="background-color: #fff; color: black;">{{$ubicacion->ubicacion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Pz. Dental</label>
                                <select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="pz_edit0" id="pz_edit0" onchange="desactivar_elegido(this);" required data-numero="" data-elegido="no">
                                    <option disabled value="" selected>.:selecciona:.</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 20px;">
                                <label>Procedimiento</label>
                                <select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="procedimiento_edit0" id="procedimiento_edit0" onchange="sacar_costos_edit(this);" required data-costo="" data-costo_publico="">
                                    <option disabled value="" selected >.:selecciona:.</option>
                                    @foreach($procedimientos as $procedimiento)
                                     <option value="{{$procedimiento->id}}" style="background-color: #fff; color: black;">{{$procedimiento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 20px;">
                                <label >Descuento</label>
                                <div class="input-group mb-3">
                                  <span class="input-group-text" style="border-color: #D6802E;">%</span>
                                  <input type="number" class="form-control" name="descuento_edit0" id="descuento_edit0" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" placeholder="Descuento" onkeyup="resultados_edit();" onchange="resultados_edit();">
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <button type="button" class="btn" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%; background-color: #2FB4D6; color: #fff; word-wrap: break-word;" onclick="mas_procedimientos_edit();">Agregar</button>
                            </div>
                        </div>

                        <div id="listado_padre_edit" style="overflow-y: auto; overflow-x: hidden; width: 100%; max-height: 300px;" class="multiple">
                            
                        </div>

                    </div>
                </div>
                <br><br>
                <label>Observaciones</label>
                <textarea name="observacion_edit" id="observacion_edit" class="form-control" style="border-color: #D6802E" placeholder="Observaciones" rows="2"></textarea>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_presupuesto_edit" id="id_presupuesto_edit">
                <input type="hidden" name="numero_de_procedimientos_edit" id="numero_de_procedimientos_edit" value="">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button class="btn btn-success">Editar</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- modal de eliminar presupuesto-->
<div class="modal fade" id="eliminar_presupuesto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar Presupuesto</h5>
        </div>
        <form action="{{url('/delete_presupuesto')}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              <label style="font-family: cursive; font-size: 20px; display:flex; justify-content: center;align-items: center; height: 100%;">¿Quieres Eliminar el procedimiento?</label><br>
                <div style="text-align: center;">
                    <label style="font-family: cursive; font-size: 25px;" id="labeleliminar"></label>
                     </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_presupuesto_delete" id="id_presupuesto_delete">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger" >Eliminar</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!--menu de opciones de la tabla-->
<div id="menu_opciones" class="visible_off " style=" padding: 25px; background-color: #66697569;">
    <button type="button" class="close" style="margin-right: -17px; margin-top: -20px;" onclick="cerrar_menu();">
       <i class="fas fa-times fa-xs"></i>
    </button>
    <button class="btn btn-warning form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#eliminar_presupuesto" onclick="date_mat();">
        Eliminar
    </button>
    <br>
    <button type="button" class="btn btn-info form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#editarPre" onclick="activar_select2_editar();" >
        Editar
    </button>
    <br>
    <button type="button" class="btn btn-warning form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#pdf_externo" onclick="agregar_url();" >
        PDF Ext.
    </button>
    <br>
    <button type="button" class="btn btn-info form-control" style="margin-bottom: 10px; font-weight: bold;" data-toggle="modal" data-target="#pdf_interno" onclick="agregar_url();">
        PDF Int.
    </button>

</div>

<!-- modal de pdf externo-->
<div class="modal fade" id="pdf_externo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PDF Externo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; SI NO SE DESCARGO PRECIONA EL BOTON!</p>
                <a class="btn btn-success" target="_blank" href="" id="ver">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="" style="width:100%; height: 600px;" id="embad">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- modal de pdf externo-->
<div class="modal fade" id="pdf_interno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PDF Interno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">

            <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira_2">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; SI NO SE DESCARGO PRECIONA EL BOTON!</p>
                <a class="btn btn-success" target="_blank" href="" id="ver_2">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="" style="width:100%; height: 600px;" id="embad_2">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
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
        background-color: #D6802E;
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

    .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #D6802E !important;
        background-color: #D6802E;

    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: white !important;
        
    }
    
    .select2-container--default .select2-selection--single {
        border: 1px solid #D6802E !important;
        color: white !important;
        
        background-color: #D6802E !important;
    }

    

    /*estos son para la flechita, se agrego otra ya que se ve mejor de color blanco*/
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      background-image: url(./img/f_abajo.png);
      background-color: transparent;
      background-size: contain;
      border: none !important;
      height: 20px !important;
      width: 20px !important;
      margin: auto !important;
      top: 8px !important;
      left: auto !important;
    }

    

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        transform: rotate(180deg) !important;
    }

    .flechita {
        background-image: url(./img/f_abajo.png) !important; /*aquí deberás escribir la ruta de la imagen que utilizarás como flecha del desplegable*/
        background-repeat: no-repeat !important;
        background-position: 98% center !important;
        background-size: 20px !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        -o-appearance: none !important;
        appearance: none !important;
     }
     .flechita::-ms-expand {
        display: none; /*Evita que se muestre la flecha por defecto en versiones de IE*/
     }
     
</style>
@stop

@section('js')

<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- este es para el selected2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    var allproce_ser=null;
    //funcion de la tabla de boostrap tenga paginador y buscador
  $(document).ready(function() {

    $.ajax({
      url: "{{url('/all_procedimientos')}}",
      dataType: "json",
      timeout : 80000,
      //context: document.body
    }).done(function(allproce) {

      if(allproce==null){
        allproce_ser=null;
      }else{
        allproce_ser=allproce;
      }
    });



    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });

    $('.js-example-basic-single').select2({
        dropdownParent: $('#nuevoPre .modal-body')
    });
  });

  //jquery para desvanecer el mensage
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });

    function agregar_url(){
        var url="{{url('/pdf_externo')}}"+"/";
        var url_2="{{url('/pdf_interno')}}"+"/";
        document.getElementById("embad").src=url+id_presupuesto;
        document.getElementById("ver").href=url+id_presupuesto;
        document.getElementById("embad_2").src=url_2+id_presupuesto;
        document.getElementById("ver_2").href=url_2+id_presupuesto;

    }
    function date_mat(){

        $.ajax({
          url: "{{url('/procedimientos_presupuesto')}}"+'/'+id_presupuesto,
          dataType: "json",
          timeout : 80000,
          //context: document.body
        }).done(function(procedimientos_pre) {

          if(procedimientos_pre==null){
            document.getElementById("labeleliminar").innerHTML=null;
            document.getElementById("id_presupuesto_delete").value=null;
          }else{
            document.getElementById("labeleliminar").innerHTML=procedimientos_pre[0].nombre;
            document.getElementById("id_presupuesto_delete").value=procedimientos_pre[0].id;
          }
        });
    }

    //cuadro de opciones
    var id_presupuesto=null;
    function pasar_id($id_tr) {

        id_presupuesto=$id_tr;
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        document.getElementById("menu_opciones").style.top=coordenadas_y-50+"px";
        document.getElementById("menu_opciones").style.left=coordenadas_x-50+"px";
        document.getElementById("menu_opciones").classList.add("visible_on");
        document.getElementById("menu_opciones").classList.remove("visible_off");
      //alert($id_tr);
    }
    document.getElementById("menu_opciones").addEventListener("mouseleave",function(){
          document.getElementById("menu_opciones").classList.remove("visible_on");
          document.getElementById("menu_opciones").classList.add("visible_off");
    });
    function cerrar_menu(){
        document.getElementById("menu_opciones").classList.remove("visible_on");
        document.getElementById("menu_opciones").classList.add("visible_off");
    }

  function sacar_costos(select) {
      $.ajax({
          url: "{{url('/procedimientoSearch')}}"+'/'+select.value,
          dataType: "json",
          timeout : 80000,
        }).done(function(procedimiento_result) {

          if(procedimiento_result==null){
            alert("la base de datos esta fallando compa");
          }else{
           
            select.dataset.costo=procedimiento_result.costo;
            select.dataset.costo_publico=procedimiento_result.costo_publico;
            resultados();

            
          }
        });
  }


function agregar_dientes(indice){
    var ruta_buscar=null;
    try{
        if (document.getElementById("ubicacion"+indice).value!=0 && document.getElementById("tipo").value!=0){
             $("#pz"+indice).empty();

            if (document.getElementById("ubicacion"+indice).value!=3){


                if (document.getElementById("ubicacion"+indice).value==1 && document.getElementById("tipo").value==1){
                    ruta_buscar="{{url('/Superior_Permanentes')}}";
                }

                if (document.getElementById("ubicacion"+indice).value==2 && document.getElementById("tipo").value==1){
                    ruta_buscar="{{url('/Inferior_Permanentes')}}";
                }
                //modelo 2
                if (document.getElementById("ubicacion"+indice).value==1 && document.getElementById("tipo").value==2){
                    ruta_buscar="{{url('/Superior_Temporales')}}";
                }

                if (document.getElementById("ubicacion"+indice).value==2 && document.getElementById("tipo").value==2){
                    ruta_buscar="{{url('/Inferior_Temporales')}}";
                }
                //modelo 3
                if (document.getElementById("ubicacion"+indice).value==1 && document.getElementById("tipo").value==3){
                    ruta_buscar="{{url('/Superior_Mixta')}}";
                }

                if (document.getElementById("ubicacion"+indice).value==2 && document.getElementById("tipo").value==3){
                    ruta_buscar="{{url('/Inferior_Mixta')}}";
                }
                

                $.ajax({
                  url: ruta_buscar,
                  dataType: "json",
                  timeout : 80000,
                }).done(function(dientes_result) {
                  if(dientes_result==null){
                    alert("la base de datos esta fallando compa");
                  }else{

                    $("#pz"+indice).append(
                                '<option value="">.:selecciona:.</option>'
                            );

                    if (document.getElementById("tipo").value!=3){
                        for (var i = 0; i < dientes_result.length; i++) {
                            $("#pz"+indice).append(
                                '<option value="'+dientes_result[i].numero_asignado+'">'+dientes_result[i].pz_dental+'</option>'
                            );
                        }
                        

                    }else{

                        for (var i = 0; i < dientes_result[0].length; i++) {
                            $("#pz"+indice).append(
                                '<option value="'+dientes_result[0][i].numero_asignado+'">'+dientes_result[0][i].pz_dental+'</option>'
                            );
                        }
                        for (var i = 0; i < dientes_result[1].length; i++) {
                            $("#pz"+indice).append(
                                '<option value="'+dientes_result[1][i].numero_asignado+'">'+dientes_result[1][i].pz_dental+'</option>'
                            );
                        }

                    }
                    
                  }
                });

            }else{

                $("#pz"+indice).append(
                    '<option value="'+100+'" selected>Todos</option>'
                );
            }


        }
        
        
    }catch(TypeError){
        console.log("no existe");
    }

}

function reinicio_dientes(){

    for (var i = 0; i < j; i++) {
        agregar_dientes(i);
    }
    //alert("se reiniciaron todas las opcines \"Pz. Dental\" por que se cambio el primero filtro \"Tipo\"");
}

function resultados(){
    var total_invercion=0;
    var total_publico=0;
    for (var i = 0; i < j; i++) {
        try{
            var invercion_unico=Number(document.getElementById("procedimiento"+i).dataset.costo);
            var costo_publico_unico=Number(document.getElementById("procedimiento"+i).dataset.costo_publico);
            var descuento=Number(document.getElementById("descuento"+i).value);
            var costo_publico_unico_total=0;

            if(descuento==0 || costo_publico_unico==0){
                costo_publico_unico_total=costo_publico_unico;
            }else{
                costo_publico_unico_total=(costo_publico_unico-((costo_publico_unico*descuento)/100));
            }
            total_invercion+=invercion_unico;
            total_publico+=costo_publico_unico_total;
            document.getElementById("importe_to").value=total_invercion.toFixed(2);
            document.getElementById("costo_pu").value=total_publico.toFixed(2);
        }catch(TypeError){

        }
    }
    document.getElementById("utilidad").value=(total_publico-total_invercion).toFixed(2);
    if (total_publico==0 && total_invercion==0){
        document.getElementById("porcentaje_ga").value=0+"%";
    }else{
        document.getElementById("porcentaje_ga").value=(((total_publico*100)/total_invercion)-100).toFixed(2)+"%";
    }
    
}

var j=1;
function mas_procedimientos(){

    document.getElementById("listado_padre").style="overflow: hidden auto; width: 100%; max-height: 300px;";
    $("#listado_padre").append(

        '<div class="row" id="fila_hija'+j+'">'+
            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                '<label >Ubicacion</label>'+
                '<select class=" form-control flechita" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="ubicacion'+j+'" id="ubicacion'+j+'" onchange="agregar_dientes('+j+');" required>'+
                    '<option disabled value="" selected style="background-color: #fff; color: black;">.:selecciona:.</option>'+
                    '@foreach($ubicacions as $ubicacion)'+
                     '<option value="{{$ubicacion->id}}" style="background-color: #fff; color: black;">{{$ubicacion->ubicacion}}</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                '<label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Pz. Dental</label>'+
                '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="pz'+j+'" id="pz'+j+'" onchange="" required >'+
                    '<option disabled value="" selected>.:selecciona:.</option>'+ 
                '</select>'+
            '</div>'+
            '<div class="col-md-3" style="margin-bottom: 20px;">'+
                '<label>Procedimiento</label>'+
                '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="procedimiento'+j+'" id="procedimiento'+j+'" onchange="sacar_costos(this);" required data-costo="" data-costo_publico="">'+
                    '<option disabled value="" selected >.:selecciona:.</option>'+
                    '@foreach($procedimientos as $procedimiento)'+
                     '<option value="{{$procedimiento->id}}" style="background-color: #fff; color: black;">{{$procedimiento->nombre}}</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
            '<div class="col-md-3" style="margin-bottom: 20px;">'+
                '<label >Descuento</label>'+
                '<div class="input-group mb-3">'+
                  '<span class="input-group-text" style="border-color: #D6802E;">%</span>'+
                  '<input type="number" class="form-control" name="descuento'+j+'" id="descuento'+j+'" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" placeholder="Descuento" onkeyup="resultados();" onchange="resultados();">'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                '<button type="button" class="btn btn-danger eliminar_hijo" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%;  color: #fff; word-wrap: break-word;" id="'+j+'">Eliminar</button>'+
            '</div>'+
        '</div>'
    );
    j++;
    //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
    $('.js-example-basic-single').select2({
        dropdownParent: $('#nuevoPre .modal-body')
    });

    document.getElementById("numero_de_procedimientos").value=j;
}

$(document).on('click', '.eliminar_hijo', function(){
    var id=$(this).attr("id"); 
    $('#fila_hija'+id+'').remove();
    document.getElementById("numero_de_procedimientos").value=j;
    resultados();
});


/////////////////////////////////////////////////////////////////////////////////////////





function sacar_costos_edit(select) {
    //console.log(allproce_ser);
    if (allproce_ser==null){
        sacar_costos_edit_forma_1(select);
    }else{
        sacar_costos_edit_forma_2(select);
    }
}

function sacar_costos_edit_forma_2(select) {
    
    for (var i = 0; i<=allproce_ser.length; i++) {
        if (allproce_ser[i].id==select.value){
            select.dataset.costo=allproce_ser[i].costo;
            select.dataset.costo_publico=allproce_ser[i].costo_publico;
            break;
        }
        
    }
    resultados_edit();
}


//esta es la primera forma, pero sera acompañada de otra por que no responde el ervidor, el nombre sera cambiado por que lo tendra otra funcion, el nombre es sacar_costos_edit(select)
function sacar_costos_edit_forma_1(select) {
  $.ajax({
      url: "{{url('/procedimientoSearch')}}"+'/'+select.value,
      dataType: "json",
      timeout : 80000,
    }).done(function(procedimiento_result) {

      if(procedimiento_result==null){
        alert("la base de datos esta fallando compa");
      }else{
       
        select.dataset.costo=procedimiento_result.costo;
        select.dataset.costo_publico=procedimiento_result.costo_publico;
        resultados_edit();

        
      }
    });
}


function agregar_dientes_edit(indice){
    var ruta_buscar=null;
    try{
        if (document.getElementById("ubicacion_edit"+indice).value!=0 && document.getElementById("tipo_edit").value!=0){
             $("#pz_edit"+indice).empty();

            if (document.getElementById("ubicacion_edit"+indice).value!=3){


                if (document.getElementById("ubicacion_edit"+indice).value==1 && document.getElementById("tipo_edit").value==1){
                    ruta_buscar="{{url('/Superior_Permanentes')}}";
                }

                if (document.getElementById("ubicacion_edit"+indice).value==2 && document.getElementById("tipo_edit").value==1){
                    ruta_buscar="{{url('/Inferior_Permanentes')}}";
                }
                //modelo 2
                if (document.getElementById("ubicacion_edit"+indice).value==1 && document.getElementById("tipo_edit").value==2){
                    ruta_buscar="{{url('/Superior_Temporales')}}";
                }

                if (document.getElementById("ubicacion_edit"+indice).value==2 && document.getElementById("tipo_edit").value==2){
                    ruta_buscar="{{url('/Inferior_Temporales')}}";
                }
                //modelo 3
                if (document.getElementById("ubicacion_edit"+indice).value==1 && document.getElementById("tipo_edit").value==3){
                    ruta_buscar="{{url('/Superior_Mixta')}}";
                }

                if (document.getElementById("ubicacion_edit"+indice).value==2 && document.getElementById("tipo_edit").value==3){
                    ruta_buscar="{{url('/Inferior_Mixta')}}";
                }
                

                $.ajax({
                  url: ruta_buscar,
                  dataType: "json",
                  timeout : 80000,
                }).done(function(dientes_result) {
                  if(dientes_result==null){
                    alert("la base de datos esta fallando compa");
                  }else{

                    $("#pz_edit"+indice).append(
                                '<option value="" selected disabled>.:selecciona:.</option>'
                            );

                    if (document.getElementById("tipo_edit").value!=3){
                        for (var i = 0; i < dientes_result.length; i++) {
                            $("#pz_edit"+indice).append(
                                '<option value="'+dientes_result[i].numero_asignado+'">'+dientes_result[i].pz_dental+'</option>'
                            );
                        }
                        

                    }else{

                        for (var i = 0; i < dientes_result[0].length; i++) {
                            $("#pz_edit"+indice).append(
                                '<option value="'+dientes_result[0][i].numero_asignado+'">'+dientes_result[0][i].pz_dental+'</option>'
                            );
                        }
                        for (var i = 0; i < dientes_result[1].length; i++) {
                            $("#pz_edit"+indice).append(
                                '<option value="'+dientes_result[1][i].numero_asignado+'">'+dientes_result[1][i].pz_dental+'</option>'
                            );
                        }

                    }
                    
                  }
                  //console.log("llenado");
                  //este solo es para que seleccione cuando se llena por ajax, no carga si no lo hago directamente aqui, este estara acmpañada de una funcion que desactive elegido
                  if(document.getElementById("pz_edit"+indice).dataset.elegido=="no"){
                    var dato=document.getElementById("pz_edit"+indice).dataset.numero;
                    //console.log("eleccion");
                    $("#pz_edit"+indice).val(dato).trigger('change');
                  }
                });

            }else{

                $("#pz_edit"+indice).append(
                    '<option value="'+100+'" selected>Todos</option>'
                );
            }


        }
        
        
    }catch(TypeError){
        console.log("no existe");
    }

}

function desactivar_elegido(select){

    select.dataset.elegido="si";

}

function reinicio_dientes_edit(){

    for (var i = 0; i < j_2; i++) {
        agregar_dientes_edit(i);
    }
    //alert("se reiniciaron todas las opcines \"Pz. Dental\" por que se cambio el primero filtro \"Tipo\"");
}

function resultados_edit(){
    var total_invercion=0;
    var total_publico=0;
    for (var i = 0; i < j_2; i++) {
        try{
            var invercion_unico=Number(document.getElementById("procedimiento_edit"+i).dataset.costo);
            var costo_publico_unico=Number(document.getElementById("procedimiento_edit"+i).dataset.costo_publico);
            var descuento=Number(document.getElementById("descuento_edit"+i).value);
            var costo_publico_unico_total=0;

            if(descuento==0 || costo_publico_unico==0){
                costo_publico_unico_total=costo_publico_unico;
            }else{
                costo_publico_unico_total=(costo_publico_unico-((costo_publico_unico*descuento)/100));
            }
            total_invercion+=invercion_unico;
            total_publico+=costo_publico_unico_total;
            document.getElementById("importe_to_edit").value=total_invercion.toFixed(2);
            document.getElementById("costo_pu_edit").value=total_publico.toFixed(2);
        }catch(TypeError){

        }
    }
    document.getElementById("utilidad_edit").value=(total_publico-total_invercion).toFixed(2);
    if (total_publico==0 && total_invercion==0){
        document.getElementById("porcentaje_ga_edit").value=0+"%";
    }else{
        document.getElementById("porcentaje_ga_edit").value=(((total_publico*100)/total_invercion)-100).toFixed(2)+"%";
    }
    
}

var j_2=1;
function mas_procedimientos_edit(){

    document.getElementById("listado_padre_edit").style="overflow: hidden auto; width: 100%; max-height: 300px;";
    $("#listado_padre_edit").append(

        '<div class="row" id="fila_hija_edit'+j_2+'">'+
            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                '<label >Ubicacion</label>'+
                '<select class=" form-control flechita" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="ubicacion_edit'+j_2+'" id="ubicacion_edit'+j_2+'" onchange="agregar_dientes_edit('+j_2+');" required>'+
                    '<option disabled value="" selected style="background-color: #fff; color: black;">.:selecciona:.</option>'+
                    '@foreach($ubicacions as $ubicacion)'+
                     '<option value="{{$ubicacion->id}}" style="background-color: #fff; color: black;">{{$ubicacion->ubicacion}}</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                '<label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Pz. Dental</label>'+
                '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="pz_edit'+j_2+'" id="pz_edit'+j_2+'" onchange="desactivar_elegido(this);" required data-numero="" data-elegido="no">'+
                    '<option disabled value="" selected>.:selecciona:.</option>'+ 
                '</select>'+
            '</div>'+
            '<div class="col-md-3" style="margin-bottom: 20px;">'+
                '<label>Procedimiento</label>'+
                '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="procedimiento_edit'+j_2+'" id="procedimiento_edit'+j_2+'" onchange="sacar_costos_edit(this);" required data-costo="" data-costo_publico="">'+
                    '<option disabled value="" selected >.:selecciona:.</option>'+
                    '@foreach($procedimientos as $procedimiento)'+
                     '<option value="{{$procedimiento->id}}" style="background-color: #fff; color: black;">{{$procedimiento->nombre}}</option>'+
                    '@endforeach'+
                '</select>'+
            '</div>'+
            '<div class="col-md-3" style="margin-bottom: 20px;">'+
                '<label >Descuento</label>'+
                '<div class="input-group mb-3">'+
                  '<span class="input-group-text" style="border-color: #D6802E;">%</span>'+
                  '<input type="number" class="form-control" name="descuento_edit'+j_2+'" id="descuento_edit'+j_2+'" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" placeholder="Descuento" onkeyup="resultados_edit();" onchange="resultados_edit();">'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2" style="margin-bottom: 20px;">'+
                '<button type="button" class="btn btn-danger eliminar_hijo_edit" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%;  color: #fff; word-wrap: break-word;" id="'+j_2+'">Eliminar</button>'+
            '</div>'+
        '</div>'
    );
    j_2++;
    //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
    $('.js-example-basic-single').select2({
        dropdownParent: $('#editarPre .modal-body')
    });

    document.getElementById("numero_de_procedimientos_edit").value=j_2;
}

$(document).on('click', '.eliminar_hijo_edit', function(){
    var id=$(this).attr("id"); 
    $('#fila_hija_edit'+id+'').remove();
    document.getElementById("numero_de_procedimientos_edit").value=j_2;
    resultados_edit();
});





function activar_select2_editar(){

    $('.js-example-basic-single').select2({
        dropdownParent: $('#editarPre .modal-body')
    });

    llenar_datos();
}

function activar_select2(){

    $('.js-example-basic-single').select2({
        dropdownParent: $('#nuevoPre .modal-body')
    });

}

function llenar_datos(){

    j_2=1;
    document.getElementById("pz_edit0").dataset.elegido="no";
    document.getElementById("listado_padre_edit").innerHTML="";
    $.ajax({
      url: "{{url('/procedimientos_presupuesto')}}"+'/'+id_presupuesto,
      dataType: "json",
      timeout : 80000,
    }).done(function(procedimientos_pre) {

      if(procedimientos_pre==null){
        alert("la base de datos esta fallando compa");
        document.getElementById("id_presupuesto_edit").value=null;
      }else{
        document.getElementById("id_presupuesto_edit").value=id_presupuesto;
        //console.log(procedimientos_pre);
        for (var i = 0; i <procedimientos_pre[1].length; i++) {
            //console.log(procedimientos_pre[1][i].numero_asignado_pz);
            if (i==0){

                document.getElementById("nombre_edit").value=procedimientos_pre[0].nombre;
                $("#sexo_edit").val(procedimientos_pre[0].id_sexo).trigger('change');
                $("#tipo_edit").val(procedimientos_pre[0].id_tipo).trigger('change');
                document.getElementById("edad_edit").value=procedimientos_pre[0].edad;
                document.getElementById("importe_to_edit").value=procedimientos_pre[0].invercion;
                document.getElementById("costo_pu_edit").value=procedimientos_pre[0].costo_publico;
                document.getElementById("utilidad_edit").value=procedimientos_pre[0].utilidad;
                document.getElementById("porcentaje_ga_edit").value=procedimientos_pre[0].porcentaje;
                document.getElementById("observacion_edit").value=procedimientos_pre[0].observaciones;
                $("#ubicacion_edit0").val(procedimientos_pre[1][i].id_ubicacion).trigger('change');
                //$("#pz_edit0").val(procedimientos_pre[1][i].numero_asignado_pz).trigger('change');
                document.getElementById("pz_edit0").dataset.numero=procedimientos_pre[1][i].numero_asignado_pz;
                $("#procedimiento_edit0").val(procedimientos_pre[1][i].id_procedimiento).trigger('change');
                document.getElementById("descuento_edit0").value=procedimientos_pre[1][i].descuento;

            }else{
                document.getElementById("listado_padre_edit").style="overflow: hidden auto; width: 100%; max-height: 350px;";
                $("#listado_padre_edit").append(

                    '<div class="row" id="fila_hija_edit'+j_2+'">'+
                        '<div class="col-md-2" style="margin-bottom: 20px;">'+
                            '<label >Ubicacion</label>'+
                            '<select class=" form-control flechita" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="ubicacion_edit'+j_2+'" id="ubicacion_edit'+j_2+'" onchange="agregar_dientes_edit('+j_2+');" required>'+
                                '<option disabled value="" selected style="background-color: #fff; color: black;">.:selecciona:.</option>'+
                                '@foreach($ubicacions as $ubicacion)'+
                                 '<option value="{{$ubicacion->id}}" style="background-color: #fff; color: black;">{{$ubicacion->ubicacion}}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-md-2" style="margin-bottom: 20px;">'+
                            '<label style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; width:100%;">Pz. Dental</label>'+
                            '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="pz_edit'+j_2+'" id="pz_edit'+j_2+'" onchange="desactivar_elegido(this);" required data-numero="" data-elegido="no">'+
                                '<option disabled value="" selected>.:selecciona:.</option>'+ 
                            '</select>'+
                        '</div>'+
                        '<div class="col-md-3" style="margin-bottom: 20px;">'+
                            '<label>Procedimiento</label>'+
                            '<select class="js-example-basic-single form-control" style="border-color: #D6802E; width: 100%; color: white; background-color: #D6802E; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" name="procedimiento_edit'+j_2+'" id="procedimiento_edit'+j_2+'" onchange="sacar_costos_edit(this);" required data-costo="" data-costo_publico="">'+
                                '<option disabled value="" selected >.:selecciona:.</option>'+
                                '@foreach($procedimientos as $procedimiento)'+
                                 '<option value="{{$procedimiento->id}}" style="background-color: #fff; color: black;">{{$procedimiento->nombre}}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-md-3" style="margin-bottom: 20px;">'+
                            '<label >Descuento</label>'+
                            '<div class="input-group mb-3">'+
                              '<span class="input-group-text" style="border-color: #D6802E;">%</span>'+
                              '<input type="number" class="form-control" name="descuento_edit'+j_2+'" id="descuento_edit'+j_2+'" style="border-color: #D6802E;"  pattern="^[0-9]" min="0" placeholder="Descuento" onkeyup="resultados_edit();" onchange="resultados_edit();" value="'+procedimientos_pre[1][i].descuento+'">'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-md-2" style="margin-bottom: 20px;">'+
                            '<button type="button" class="btn btn-danger eliminar_hijo_edit" style="font-size: 15px; font-weight: bold; margin-top: 32px; width: 100%;  color: #fff; word-wrap: break-word;" id="'+j_2+'">Eliminar</button>'+
                        '</div>'+
                    '</div>'

                );
                $("#ubicacion_edit"+j_2).val(procedimientos_pre[1][i].id_ubicacion).trigger('change');
                //$("#pz_edit"+j_2).val(procedimientos_pre[1][i].numero_asignado_pz).trigger('change');
                document.getElementById("pz_edit"+j_2).dataset.numero=procedimientos_pre[1][i].numero_asignado_pz;
                $("#procedimiento_edit"+j_2).val(procedimientos_pre[1][i].id_procedimiento).trigger('change');

                j_2++;

                //este solo es necesario para el select2, se hace para que se buelva activar la api en el nuevo select creado.
                $('.js-example-basic-single').select2({
                    dropdownParent: $('#editarPre .modal-body')
                });
                document.getElementById("numero_de_procedimientos_edit").value=j_2;

                //este solo lo agrego por si existe la primera consulta de todos los procedimientos 
                if(allproce_ser!=null){
                    resultados_edit();
                }
                


            }


            //
        }

        
      }
    });


    

}

//este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        document.getElementById("no_se_mira").style.display="block";
        document.getElementById("no_se_mira_2").style.display="block";
    }else{
        document.getElementById("no_se_mira").style.display="none";
        document.getElementById("no_se_mira_2").style.display="none";
    }


</script>

@stop
