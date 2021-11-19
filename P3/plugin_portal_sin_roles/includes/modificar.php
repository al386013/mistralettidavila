<?php
/**
* @title: P2 PHP modificar.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include("gestion_BD.php");

function cargarDatos($pdo,$table)
{
    $result=consultarActividad($pdo,$table,$_REQUEST['id']);
    if (is_array($result)) {
        $actividad = $result[0];
        $nombre = $actividad ['nombre'];
        $descripcion = $actividad ['descripcion'];
        $localizacion = $actividad ['localizacion'];
        $fecha = $actividad ['fecha'];
        $hora = $actividad ['hora'];
        include(dirname(__FILE__)."/../partials/centralForm.php");
    }
    else {
        echo 'La actividad con id ', $_REQUEST['id'], ' no existe en la base de datos';
    }
}

try{
    cargarDatos($pdo,$table);
}
catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}

?>