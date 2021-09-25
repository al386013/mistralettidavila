<?php
include("./gestion_BD.php");

function handler($pdo,$table)
{
    
    $datos = $_REQUEST;
    if (count($_REQUEST) < 2) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $query = "INSERT INTO     $table (nombre, descripcion)
                        VALUES (?,?)";
                       
    echo $query;
    try { 
        $a=array($_REQUEST['nombre'], $_REQUEST['descripcion'] );
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($_REQUEST['nombre'], $_REQUEST['descripcion'] ));
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = $table2;
handler( $pdo,$table);
?>