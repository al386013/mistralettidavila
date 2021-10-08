<?php
/**
* @title: P2 PHP gestion_BD.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include(dirname(__FILE__) . "/../../../wp-config.php");

// /** The name of the database */
define('DB_NAME', 'ei1036_42');

// /** MySQL database username */
define('DB_USER', 'dllido');

// /** MySQL database password */
define('DB_PASSWORD', 'luki.99');

// /** MySQL hostname */
define('DB_HOST', 'db-aules.uji.es' );

// /** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

// /** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* Consultas 
 $query = "INSERT INTO    $table (?) VALUES (?,?,?,?,?)";
 $query = "DELETE   FROM   $table WHERE actividad_id =(?)";
 $query = "SELECT     * FROM       $table "; 
 */

function eliminarTabla($pdo, $table)
{
   try {
      $query = "DROP TABLE $table";
               
      $pdo->exec($query);
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function crearTablaActividades($pdo, $table)
{
   try {
      //Crea tabla si no existe
      $query = "CREATE TABLE IF NOT EXISTS  $table (
               actividad_id SERIAL PRIMARY KEY, 
               nombre CHAR(50) NOT NULL,
               descripcion CHAR(250), 
               localizacion CHAR(50) NOT NULL,
               fecha DATE NOT NULL,
               hora TIME NOT NULL);";

      $pdo->exec($query);
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function crearTablaClientes($pdo, $table)
{
   try {
      $query="CREATE TABLE IF NOT EXISTS  $table (
               id SERIAL PRIMARY KEY, 
               nombre CHAR(50) NOT NULL, 
               surname CHAR(50) , 
               address CHAR(50),
               city CHAR(50),
               zip_code CHAR(5),
               foto_file VARCHAR(25) );";
	
      $pdo->exec($query);
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function consultar($pdo, $table)
{
   $query = "SELECT     * FROM       $table ";
   $consult = $pdo->prepare($query);
   $a = $consult->execute(array());
   if (1 > $a) {
      echo "Consulta incorrecta de la tabla ";
      echo $table;
   }
   return ($consult->fetchAll(PDO::FETCH_ASSOC));
}

function consultarActividad($pdo, $table, $id)
{
   $query = "SELECT     * FROM       $table WHERE actividad_id=(?)";
   $consult = $pdo->prepare($query);
   $a = $consult->execute(array($id));
   if (1 > $a) {
      echo "Consulta de actividad incorrecta";
      echo $table;
   }
   return ($consult->fetchAll(PDO::FETCH_ASSOC));
}

function consultarActividadDatos($pdo, $table, $id ,$nombre )
{
   $query = "SELECT     * FROM       $table WHERE actividad_id =(?) ,nombre=(?) ";
   $consult = $pdo->prepare($query);
   $a = $consult->execute(array($id ,$nombre));
   if (1 > $a) {
      echo "Consulta de actividad incorrecta datos";
      echo $table;
   }
   return ($consult->fetchAll(PDO::FETCH_ASSOC));
}

function anyadir($pdo, $table, $valores)
{
   try {
      $query = "INSERT INTO $table (nombre, descripcion, localizacion, fecha, hora) VALUES (?,?,?,?,?)";
      $consult = $pdo->prepare($query);
      $a = $consult->execute($valores);
      if (1 > $a) echo "No se ha podido registrar la actividad";
      else echo '<p class="anuncio">¡Actividad registrada con éxito!</p>';
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function modificar($pdo, $table, $valores)
{
   try {
      $query = "UPDATE $table SET nombre=(?),descripcion=(?),localizacion=(?),fecha=(?) ,hora=(?) WHERE actividad_id=(?)";
      $consult = $pdo->prepare($query);
      $a = $consult->execute($valores);
      if (1 > $a) echo "No se ha podido modificar la actividad";
      else echo '<p class="anuncio">¡Actividad modificada con éxito!</p>';
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function borrar($pdo, $table, $id)
{
   try {
      $query = "DELETE FROM    $table WHERE actividad_id =(?)";
      $consult = $pdo->prepare($query);
      $a = $consult->execute(array($id));
      if (1 > $a) echo "No se ha podido borrar la actividad";
      else echo '<p class="anuncio">¡Actividad borrada con éxito!</p>';
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  

$table1="al386179_clientes";
$table2="al386179_actividades";
