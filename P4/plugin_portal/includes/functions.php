<?php
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author  Jorge Davila <al386179@uji.es> Melani Mistraletti <al386013@uji.es>
 * * @copyright 2021 TSD
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 * */

//Estas 2 instrucciones me aseguran que el usuario accede a través del WP. Y no directamente
if ( ! defined( 'WPINC' ) ) exit;
if ( ! defined( 'ABSPATH' ) ) exit;

//Funcion instalación plugin. Crea tabla
function crearTablaActividades()
{
   try {
      $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  
      $table="al386013_actividades";

      //Crea tabla si no existe
      $query = "CREATE TABLE IF NOT EXISTS  $table (
               actividad_id SERIAL PRIMARY KEY, 
               nombre CHAR(50) NOT NULL,
               descripcion CHAR(250) NOT NULL, 
               localizacion CHAR(50) NOT NULL,
               fecha DATE NOT NULL,
               hora TIME NOT NULL,
               foto_file VARCHAR(135),
               usuario CHAR(40) NOT NULL);";

      $pdo->exec($query);
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

//CONTROLADOR
//Esta función realizará distintas acciones en función del valor del parámetro
//$_REQUEST['proceso'], o sea se activara al llamar a url semejantes a 
//https://host/wp-admin/admin-post.php?action=actividades&proceso=listar 

function actividades_filtro()
{ 
    global $user_ID , $user_email;
    define( 'WP_USE_THEMES', true );

    //$MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    get_header();
    wp_get_current_user();   
    
    if (!(isset($_REQUEST['action'])) or !(isset($_REQUEST['proceso']))) { 
      print("Opciones no correctas $user_email"); 
      exit;
    }
  
    echo '<main id="site-content" role="main"> <div class="wrap">';

    switch ($_REQUEST['proceso']) {
      case "registro":
        $_REQUEST['id'] = null;
        $nombre = null;
        $descripcion = null;
        $localizacion = null;
        $usuario = null;
        $oculto_nombre = null;
        $central = "/../partials/centralForm.php";
        break;
      case "registrar":
        $central = "/../includes/registrar.php";
        break;
      case "listar":
        $central = "/../includes/listar.php";
        break;
      case "borrar":
        $central = "/../includes/borrar.php";
        break;
      case "modificar":
        $central = "/../includes/modificar.php";
        break;
      case "modificar2":
        $central = "/../includes/modificar2.php";
        break;
      default:
        $data["error"] = "Accion No permitida";
        echo "Proceso ", $_REQUEST['proceso'], " no permitido";
    }

    include(dirname(__FILE__).$central);
    echo "</main></div>";

    get_footer();
}


function paginasJuego(){
  require_once( ABSPATH . 'wp-admin/includes/post.php' );

  if (! post_exists('Juego1')) {
    $wordpress_page = array(
      'post_title'    => 'Juego1',
      'post_content'  => '[juego1]',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type' => 'page',
      'post_slug'=> "juego1",
    );
    wp_insert_post( $wordpress_page );

    $wordpress_page['post_title']='Juego2';
    $wordpress_page['post_content']='[juego2]';
    $wordpress_page['post_slug']='juego2';
    wp_insert_post( $wordpress_page );
  }
}
add_action( 'after_setup_theme', 'paginasJuego', 11 );


function wpdocs_plugin_name_scripts() {
  wp_enqueue_script( 'script-name1',plugins_url('../assets/carrusel.js',__FILE__ ));
  wp_enqueue_script( 'script-name2',plugins_url('../assets/registro.js',__FILE__ ));
  wp_enqueue_script( 'script-name3', plugins_url('../assets/tabla.js',__FILE__ ));
  wp_enqueue_style( 'style-name1', plugins_url('../style.css', __FILE__ ) );
  wp_enqueue_script( 'script-name6', plugins_url('../assets/deportesTemplate.js',__FILE__ ));
}

function wpdocs_add_action() {
  add_action( 'wp_enqueue_scripts', 'wpdocs_plugin_name_scripts' );
}
add_action( 'init', 'wpdocs_add_action' );

function shortcode_juego1() {
  wp_enqueue_script( 'script-name4', plugins_url('../assets/juego1.js',__FILE__ ));
}
add_shortcode( 'juego1', 'shortcode_juego1' );

function shortcode_juego2() {
  wp_enqueue_script( 'script-name5', plugins_url('../assets/laberinto.js',__FILE__ ));
}
add_shortcode( 'juego2', 'shortcode_juego2' );

/*function shortcode_template() {
  wp_enqueue_script( 'script-name6', plugins_url('../assets/deportesTemplate.js',__FILE__ ));
}
add_shortcode( 'template', 'shortcode_template' );*/

?>