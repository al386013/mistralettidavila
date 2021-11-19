<?php
/**
* @title: P3 borrar.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

if ( current_user_can('manage_options') ) {
  /*El usuario puede gestionar opciones: es un administrador*/
  include("gestion_BD.php");
  borrar($pdo,$table,$_REQUEST['id']);
} else {
  echo "<p class='aviso no-permitido'>Acción no permitida. Sólo los administradores pueden borrar una actividad.</p>";
}
include("listar.php");

?>