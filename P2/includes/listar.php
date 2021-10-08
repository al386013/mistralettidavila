<?php
include("./gestion_BD.php");

function handler($pdo,$table)
{
    echo '<h1 id="tituloListado">Oferta de actividades</h1>'; 
    $rows=consultar($pdo,$table);
    if (is_array($rows) and count($rows) > 0) {/* Creamos un listado como una tabla HTML*/
        print '<table id="tablaLista"><thead>';
        foreach ( array_keys($rows[0])as $key) {
            if(strcmp($key, 'actividad_id') !== 0) echo "<th>", $key,"</th>";
        }
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                if(strcmp($key, 'actividad_id') !== 0) echo "<td>", $val, "</td>";
            }
            print "</tr>";
        }
        print "</table>";
    } else {
        echo '<p class="anuncio">Todavía no se han registrado actividades en la asociación</p>';
    }
}

try{
    $table = $table2;
    handler($pdo,$table);
}
    catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}

?>