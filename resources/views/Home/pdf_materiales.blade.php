<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MATERIALES</title>
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
        border-bottom: 2px solid #cccccc;
    }
</style>
<body>

<header>
    <p style=" margin-top: -40px;  font-size: 20px; position: absolute;">Listas de materiales</p>
    <li style="margin-top: -6px; background-color: gray; width: 715px; list-style: none; height: 2px; position: absolute;"></li>
    <table class="table" style=" width: 100%; margin-top: 10px; text-align: left;border-collapse:collapse;">
        <thead>
            <tr>
               <th style="width: 280px; text-align: left; font-weight: 0;">Nombre</th>
               <th style="width: 90px; text-align: left; font-weight: 0;">Costo</th> 
               <th style=" text-align: left; font-weight: 0;">Unidades</th> 
               <th style=" text-align: left; font-weight: 0;">Uso por Unidad</th> 
               <th style="width: 117px; text-align: left; font-weight: 0;">Costo por Unidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiales as $material)
            <tr>
                <td class="linea" >
                    <div style="word-wrap: break-word; width: 280px;">{{$material->Nombre}}</div>
                    </td>
                <td class="linea" >${{$material->Costo}}</td>
                <td class="linea" >{{$material->Unidades}}</td>
                <td class="linea" >{{$material->Uso_de_unidad}}</td>
                <td class="linea" >${{$material->Costo_por_uso}}</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>

    
</header>


</body>

</html>



