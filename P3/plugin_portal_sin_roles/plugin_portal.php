<?php
/*
Plugin Name: plugin_portal
Description: Plugin de actividades.
Author URI: Jorge Dávila y Melani Mistraletti
Author Email: al386179@uji.es, al386013@uji.es
Version: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

require_once(plugin_dir_path( __FILE__ ).'include/functions.php');
//require_once(plugin_dir_path( __FILE__ ).'includes/gestion_BD.php');
//include_once("includes/gestion_BD.php");

//Al activar el plugin se crea la tabla de actividades en la BD, si no existe
register_activation_hook( __FILE__, 'ejecutar_crearTabla');

add_action( 'plugins_loaded', 'ejecutar_crearTabla' ); // esto se ejecuta siempre que se llama al plugin
function ejecutar_crearTabla(){
    //crearTablaActividades($pdo,$table);
    crearTablaActividades();
}


//Solo activado el hook para ejecutar mis  acciones  para usuarios autentificados,  

add_action('admin_post_actividades', 'actividades_filtro'); 
//La siguiente sentencia activaria la acción para todos los usuarios.

add_action('admin_post_nopriv_actividades', 'actividades_filtro');

// https://host/wp-admin/admin-post.php?action=actividades&proceso=listar 
//por la forma del hook, al poner wp-admin/admin-post.php?action=actividades 
//se llamará a la función actividades_filtro

?>