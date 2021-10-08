<?php
/**
* @title: P2 PHP borrar.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include("./gestion_BD.php");

try {
  $table=$table2;
  borrar($pdo,$table,$_REQUEST['id']);
  include("./listar.php");

} catch (PDOException $e) {
  echo "ERROR";
  echo "Failed to get DB handle: " . $e->getMessage() . "\n";
  exit;
}

?>