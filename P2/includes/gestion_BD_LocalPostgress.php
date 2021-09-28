<?php
#include(dirname(__FILE__)."/../../../wp-config.php");

/** The name of the database */
define('DB_NAME', 'ei1036_42');

/** MySQL database username */
define('DB_USER', 'dllido');

/** MySQL database password */
define('DB_PASSWORD', 'luki.99');

/** MySQL hostname */
define('DB_HOST', 'db-aules.uji.es' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



/* Consultas 
 $query = "INSERT INTO    $table (?) VALUES (?,?)";
 $query = "DELETE   FROM   $table WHERE actividad_id =(?)";
 $query = "SELECT     * FROM       $table "; 
  
 */
function CrearTablaActividades($pdo,$table)
{
   try {
      $table=dllido_actividades;
      $pdo = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  

      //Crea tabla si no existe
      $query="CREATE TABLE IF NOT EXISTS  $table (
         actividad_id SERIAL PRIMARY KEY, 
         nombre CHAR(50) NOT NULL,
         descripcion CHAR(250) NOT NULL, 
         localizacion CHAR(50),
         foto_file VARCHAR(50) );";

         
      $pdo->exec($query);

   catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function CrearTablaCliente($pdo,$table)
{
   try {
      $table=A_clientes;
      $query="CREATE TABLE IF NOT EXISTS  $table (actividad_id SERIAL PRIMARY KEY, nombre CHAR(50) NOT NULL, descripcion CHAR(250) NOT NULL, localización CHAR(50),foto_file VARCHAR(50) );";

      
      $pdo->exec($query);

   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function consultar($pdo,$table) 
{
   $query = "SELECT     * FROM       $table "; 
   $consult = $pdo->prepare($query);
   $a=$consult->execute(array());
   if (1>$a)echo "InCorrectoConsulta";
   return ($consult->fetchAll(PDO::FETCH_ASSOC)); 
 
}

function anyadir($pdo,$table)
{
   try {
      
      
      $valores=["actividad1","Largo actividad1"];
      $query = "INSERT INTO    $table (nombre,descripcion) VALUES (?,?)";
      $consult = $pdo->prepare($query);
      $a=$consult->execute($valores); 
      if (1>$a)echo "InCorrecto";
      $datos=consultar($pdo,$table);
      print_r($datos);
      }
      catch (PDOException $e) {
          echo "Failed to get DB handle: " . $e->getMessage() . "\n";
          exit;
        }
      
}
$pdo = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  

#crearTablaActividades()
#anyadir($pdo,$table)

 ?>