<?php
/**
* @title: P3 modificar.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include("gestion_BD.php");

//Comprobar si el usuario tiene permisos para modificar la actividad
global $user_ID , $user_email;

if ('' == $user_ID) {
  //Usuario no autenticado
  echo "<p class='aviso no-permitido'>Acción no permitida. <a href='https://mistralettidavila.cloudaccess.host/wp-login.php' target='_blank'>Inicie sesión</a> para modificar una actividad.</p>";
  include("listar.php");
} else {
  $user=$user_email;
  try{
    $result=consultarActividad($pdo,$table,$_REQUEST['id']);
    if (is_array($result)) {
        $actividad = $result[0];
        $usuario = $actividad ['usuario'];
        $nombre = $actividad ['nombre'];

        //El usuario autenticado y no administrador solo podrá modificar las actividades que ha registrado
        //El administrador puede modificar cualquier actividad
        if (current_user_can('manage_options') or $usuario == $user) {
          $descripcion = $actividad ['descripcion'];
          $localizacion = $actividad ['localizacion'];
          $fecha = $actividad ['fecha'];
          $hora = $actividad ['hora'];
          include(dirname(__FILE__)."/../partials/centralForm.php");
        } else {
          echo '<p class="aviso no-permitido">Acción no permitida. No tiene permisos para modificar la actividad "', $nombre, '".</p>';
          include("listar.php");
        }
    }
    else echo 'La actividad con id ', $_REQUEST['id'], ' no existe en la base de datos';
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
}

?>