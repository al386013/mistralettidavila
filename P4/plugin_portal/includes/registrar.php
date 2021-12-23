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
    if ('' == $user_ID or is_null($user_email)) $user="Anonimo";
    else $user=$user_email;

    $nombrefichero = null;
    //Procesar foto, si se ha subido
    if ($_FILES["foto_actividad"]['name'] != '') {
      $nombrefichero=$user."_".$_FILES["foto_actividad"]['name'];
      $destino=wp_upload_dir()['basedir']."/fotos_actividades/";
      if (!(file_exists($destino))) {
        mkdir($destino, 0777, true);
      }
      move_uploaded_file($_FILES["foto_actividad"]['tmp_name'],$destino.$nombrefichero);
    }

    $valores = array($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['localizacion'], $_REQUEST['fecha'], $_REQUEST['hora'], $nombrefichero, $user);
    anyadir($pdo, $table, $valores);
}

anyadirActividad($pdo,$table);
include("listar.php");

?>