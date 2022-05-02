<?php

$host="localhost";
$db="harvestmoon";
$user="root";
$password="";

try{
    $conexion=new PDO("mysql:host=$host;dbname=$db",$user, $password);
    if($conexion){ echo "Conectado a la Base de Datos";} //TODO eliminar una vez vea que se pruebe que funciona en todas las páginas
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>