<?php
include_once("gestion_BD.php");

function handler($pdo,$table)
{
    echo '<h1 class="page-title">Gestión de actividades</h1>';
    echo '<div class="entry-meta">Gestiona las actividades de la asociación.</div>';
    echo '<h2 class="titulo-actividades">Listado de actividades</h2>';
    $rows=consultar($pdo,$table);
    if (is_array($rows) and count($rows) > 0) { /* Creamos un listado como una tabla HTML*/
        print '<table id="tablaLista"><thead>';
        /*foreach ( array_keys($rows[0])as $key) {
            if(strcmp($key, 'actividad_id') !== 0) echo "<th>", $key,"</th>";
        }*/
        echo "<th>Nombre</th><th>Descripción</th><th>Localización</th><th>Fecha</th><th>Hora</th><th>Acciones</th>";
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                if(strcmp($key, 'actividad_id') !== 0) echo "<td>", $val, "</td>";
            }
            echo '<td><a href="?action=actividades&proceso=modificar&id=', $row['actividad_id'], '"><button class="button">Modificar</button></a><br/>';
            echo '<a href="?action=actividades&proceso=borrar&id=', $row['actividad_id'], '"><button class="button borrar">Borrar</button></a></td></td>';
            print "</tr>";
        }
        print "</table>";
    } else {
        echo '<p class="anuncio">Todavía no se han registrado actividades en la asociación</p>';
    }
}

try{
    handler($pdo,$table);
}
catch (PDOException $e) {
echo "Failed to get DB handle: " . $e->getMessage() . "\n";
exit;
}

?>