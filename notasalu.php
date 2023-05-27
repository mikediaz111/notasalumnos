<?php

if (isset($_POST["usuario"])) {
    require "vendor/autoload.php";
    $url="http://172.19.1.140/webservices/web_s.php?wsdl";
    $cliente=new nusoap_client($url,"wsdl");
    $error=$cliente->getError();
    if ($error) {
        echo "Error de conexion en el webservice: $error";
    }
    $parametros=array('alumno'=>$_POST['alumno'],'v1'=>$_POST[v1],'v2'=>$_POST[v2],'v3'=>$_POST[v3]);
    $resultado=$cliente->call('notas',$parametros);
    print_r($resultado);
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas Alumnos</title>
</head>
<body>
<form action="" method="post">
    </form>
    <form action="" method="post">
    digite nombre del alumno: <input type="text" name="alumno" id="alumno"/><br>
    digite lab 1: ___________ <input type="float" name="v1" id="v1"/><br>
    digite lab 2: ___________ <input type="float" name="v2" id="v2"/><br>
    digite parcial:__________ <input type="float" name="v3" id="v3"/><br>
    <input type="submit" value="Enviar">
    </form>
</body>
</html>
<?php
}
?>