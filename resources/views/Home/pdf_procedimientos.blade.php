<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PROCEDIMIENTOS</title>
    <link href="https://fonts.cdnfonts.com/css/letter-gothic-std-2?styles=29995" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
</head>
<style type="text/css">
    @import url('https://fonts.cdnfonts.com/css/letter-gothic-std-2?styles=29995');
    
    *{
        margin: 0;
        padding: 0;
            
        }

    body{   

        
        font-size: 15px;
        font-family: 'Letter Gothic Std', sans-serif;
        padding-top: 225px;
        padding-bottom: 75px;
        padding-right: 50px;
        padding-left: 50px;
        margin: 0;
        background-color: rgb(255, 255, 255);
        background-image: url(./formatos/Formato interno general.png);
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center center; background-attachment: fixed; 
    }

    header{
        //background-color: darkblue;
        /*height: 1615px;*/
        
    }

    .linea {
        padding-top: 20px;
        padding-bottom: 20px;
        border-bottom: 2px solid #cccccc;
    }
</style>
<body>

<header>
    <p style="margin-top: -40px;  font-size: 20px; position: absolute;" >Listas de procedimientos</p>
    <li style="margin-top: -6px; background-color: gray; width: 716px; list-style: none; height: 2px; position: absolute;"></li>
    

    <table class="table" style=" width: 100%; text-align: left;border-collapse:collapse;">
        <tbody>

            @foreach($procedimientos as $procedimiento)
            <tr>
                <td colspan="3" style="padding-bottom: 20px; padding-top: 15px;">
                    Nombre: {{$procedimiento->nombre}}
                </td>
            </tr>
            {{$importe=0}}
            @foreach($materiales_procedimientos as $materiales_procedimiento)
            @foreach($materiales as $material)
            @if($material->id==$materiales_procedimiento->id_material && $procedimiento->id==$materiales_procedimiento->id_procedimiento)
            <tr>
                <td style="width: 300px;">
                    <div style="word-wrap: break-word; width: 280px;">Material: {{$material->Nombre}}</div>
                </td>
                <td>
                    <div style="word-wrap: break-word; ">Cantidad: {{$materiales_procedimiento->usos}}</div>
                </td>
                <td>
                    <div style="word-wrap: break-word;  text-align: right;">Costo: ${{$materiales_procedimiento->usos*$material->Costo_por_uso}}</div>
                </td>
            </tr>
            {{$importe+=($materiales_procedimiento->usos*$material->Costo_por_uso)}}
            @endif
            @endforeach
            @endforeach
            <tr>
                <td colspan="3" class="espacio" style="padding-top: 20px;">
                    <div style="word-wrap: break-word;  text-align: right;">Inverción: ${{$importe}}</div>
                </td>
            </tr>


            <tr>
                <td class="linea">
                    Precio a publico: ${{$procedimiento->costo_publico}}
                </td>
                <td class="linea">
                    Utilidad: ${{$procedimiento->costo_publico-$importe}}
                </td>
                <td class="linea" style="text-align: right;">
                    Porcentaje de ganancia: ${{$procedimiento->porcentaje}}
                </td>
            </tr>
            @endforeach

        </tbody>
        
    </table>

    
</header>


</body>

</html>



