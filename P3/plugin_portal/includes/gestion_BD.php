<?php
/**
* @title: P3 gestion_BD.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

/* Consultas 
 $query = "INSERT INTO $table (?) VALUES (?,?,?,?,?,?)";
 $query = "UPDATE $table SET nombre=(?), descripcion=(?) WHERE actividad_id=(?)";
 $query = "DELETE FROM $table WHERE actividad_id =(?)";
 $query = "SELECT * FROM $table "; 
 */

function consultar($pdo, $table)
{
   $query = "SELECT * FROM $table ";
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
   $query = "SELECT * FROM $table WHERE actividad_id=(?)";
   $consult = $pdo->prepare($query);
   $a = $consult->execute(array($id));
   if (1 > $a) {
      echo "Consulta de actividad incorrecta";
      echo $table;
   }
   return ($consult->fetchAll(PDO::FETCH_ASSOC));
}

function anyadir($pdo, $table, $valores)
{
   try {
      $query = "INSERT INTO $table (nombre, descripcion, localizacion, fecha, hora, usuario) VALUES (?,?,?,?,?,?)";
      $consult = $pdo->prepare($query);
      $a = $consult->execute($valores);
      if (1 > $a) echo "No se ha podido registrar la actividad.";
      else echo '<p class="aviso">¡Actividad "', $valores[0], '" registrada con éxito!</p>';
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
      if (1 > $a) echo "No se ha podido modificar la actividad.";
      else echo '<p class="aviso">¡Actividad "', $valores[0], '" modificada con éxito!</p>';
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

function borrar($pdo, $table, $id)
{
   try {
      $query = "DELETE FROM $table WHERE actividad_id =(?)";
      $consult = $pdo->prepare($query);
      $a = $consult->execute(array($id));
      if (1 > $a) echo "No se ha podido borrar la actividad.";
      else echo '<p class="aviso">¡Actividad borrada con éxito!</p>';
   } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
   }
}

$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  
$table="al386013_actividades";

?>