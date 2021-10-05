<?php
include("./gestion_BD.php");

try {


//$table=$table1;
//crearTablaClientes($pdo,$table);

$table=$table2;
echo $table;
crearTablaActividades($pdo,$table);

 
} catch (PDOException $e) {
  echo "ERROR";
  echo "Failed to get DB handle: " . $e->getMessage() . "\n";
  exit;
}
