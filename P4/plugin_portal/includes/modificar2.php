<?php
/**
* @title: P3 modificar2.php
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

  //FOTO
  global $user_ID , $user_email;
  if ('' == $user_ID or is_null($user_email)) $user="Anonimo";
  else $user=$user_email;
  $nombrefichero = null;
  if ($_FILES["foto_actividad"]['name'] != '') {
    //Procesar foto, si se ha subido una nueva
    $nombrefichero=$user."_".$_FILES["foto_actividad"]['name'];
    $destino=wp_upload_dir()['basedir']."/fotos_actividades/";
    if (!(file_exists($destino))) {
      mkdir($destino, 0777, true);
    }
    move_uploaded_file($_FILES["foto_actividad"]['tmp_name'],$destino.$nombrefichero);
  } elseif (!is_null($_REQUEST['oculto_nombre'])) {
    //Si habia una foto para modificar y no se ha actualizado
    $nombrefichero = $_REQUEST['oculto_nombre'];
  }

  $valores = array($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['localizacion'], $_REQUEST['fecha'], $_REQUEST['hora'], $nombrefichero, $_REQUEST['id']);

  modificar($pdo, $table, $valores);
}

//Comprobar si el usuario tiene permisos para modificar la actividad
global $user_ID , $user_email;
if ('' == $user_ID) {
  //Usuario no autenticado
  echo "<p class='<aviso no-permitido'>Acción no permitida. <a href='https://mistralettidavila.cloudaccess.host/wp-login.php' target='_blank'>Inicie sesión</a> para modificar una actividad.</p>";
} else {
  //El usuario autenticado y no administrador solo podrá modificar las actividades que ha registrado
  //El administrador puede modificar cualquier actividad
  if (current_user_can('manage_options') or $usuario == $user) {
    modificarActividad($pdo, $table);
  } else {
    echo '<p class="aviso no-permitido">Acción no permitida. No tiene permisos para modificar la actividad "', $nombre, '".</p>';
  }
}

include("listar.php");

?>