<?php
/**
* @title: P2 PHP modificar2.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include("gestion_BD.php");

function modificarActividad($pdo,$table)
{
  if (count($_REQUEST) < 6) {
    $data["error"] = "No ha rellenado el formulario correctamente";
    echo "Faltan campos obligatorios por rellenar en el formulario de registro.";
    return;
  }

  $valores = array($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['localizacion'], $_REQUEST['fecha'], $_REQUEST['hora'] ,$_REQUEST['id'] );
  modificar($pdo, $table, $valores);
}

modificarActividad($pdo, $table);
include("listar.php");

?>