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
// esto deberia ir en gestion_BD.php
function crearTablaActividades()
{
   try {
      $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  
      $table="al386179_actividades";

      //Crea tabla si no existe
      $query = "CREATE TABLE IF NOT EXISTS  $table (
               actividad_id SERIAL PRIMARY KEY, 
               nombre CHAR(50) NOT NULL,
               descripcion CHAR(250) NOT NULL, 
               localizacion CHAR(50) NOT NULL,
               fecha DATE NOT NULL,
               hora TIME NOT NULL);";

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
?>