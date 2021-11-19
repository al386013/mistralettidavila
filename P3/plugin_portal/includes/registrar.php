<?php
/**
* @title: P3 registrar.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include("gestion_BD.php");

function anyadirActividad($pdo,$table)
{
    if (count($_REQUEST) < 6) {
        $data["error"] = "No ha rellenado el formulario correctamente";
        echo "Faltan campos obligatorios por rellenar en el formulario de registro.";
        return;
    }
    global $user_ID , $user_email;
    if ('' == $user_ID) $user="Anonimo";
    else $user=$user_email;

    $valores = array($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['localizacion'], $_REQUEST['fecha'], $_REQUEST['hora'], $user);
    anyadir($pdo, $table, $valores);
}

anyadirActividad($pdo,$table);
include("listar.php");

?>