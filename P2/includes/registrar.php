<?php
include("./gestion_BD.php");

function registrar($pdo,$table)
{
    $datos = $_REQUEST;
    if (count($_REQUEST) < 6) {
        $data["error"] = "No ha rellenado el formulario correctamente";
        echo "Faltan campos obligatorios por rellenar en el formulario de registro.";
        return;
    }
    $query = "INSERT INTO     $table (nombre, descripcion, localizacion, fecha, hora)
                        VALUES (?,?,?,?,?)";  
    try { 
        $a=array($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['localizacion'], $_REQUEST['fecha'], $_REQUEST['hora'] );
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['localizacion'], $_REQUEST['fecha'], $_REQUEST['hora'] ));
        if (1>$a) echo "Error en la inserción de la actividad " . $_REQUEST['nombre'];
        else {
            echo "<p class='anuncio'>¡Actividad registrada correctamente!</p>";
            include(dirname(__FILE__)."/../partials/exito.php");
        }
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = $table2;
registrar($pdo, $table);

?>