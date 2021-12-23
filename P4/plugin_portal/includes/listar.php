<?php
/**
* @title: P3 gestion_BD.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include_once("gestion_BD.php");

function coloresJS() {
    // Seccion para cambiar el color de la letra en la tabla
    echo '<p><span id="personalizar">Clica para personalizar la tabla</span></p>';
    echo '<div id="oculto" class="info"><p>Selecciona un botón para cambiar el color de la letra:</p>';
    echo '<button type="button" class="botonColor" id="rosa">Rosa</button>';
    echo '<button type="button" class="botonColor" id="azul">Azul</button>';
    echo '<button type="button" class="botonColor" id="verde">Verde</button>';
    echo '<button type="button" class="botonColor" id="naranja">Naranja</button>';
    echo '<button type="button" class="botonColor" id="blanco">Blanco</button></div>';
}

function handler($pdo,$table)
{
    echo '<h1 class="page-title">Gestión de actividades</h1>';
    echo '<div class="entry-meta">Gestiona las actividades de la asociación.</div>';
    echo '<h2 class="titulo-actividades">Listado de actividades</h2>';

    coloresJS(); 

    $rows=consultar($pdo,$table);
    if (is_array($rows) and count($rows) > 0) { /* Creamos un listado como una tabla HTML*/
        print '<table summary="Tabla de actividades de la asociación, con el nombre, descripción, localización, fecha, hora, foto y usuario de creación, así como opciones de edición y borrado."><thead><tr>';
        echo "<th>Nombre</th><th>Descripción</th><th>Localización</th><th>Fecha</th><th>Hora</th><th>Foto</th><th>Usuario</th><th>Acciones</th>";
        print "</tr></thead><tbody>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                if(strcmp($key, 'fecha') === 0) {
                  $date = new DateTime($val);
                  echo "<td class='center'>", $date->format('d/m/Y'), "</td>";
                }
                elseif(strcmp($key, 'hora') === 0) {
                  $date = new DateTime($val);
                  echo "<td class='center'>", $date->format('H:i'), "</td>";
                }
                elseif(strcmp($key, 'foto_file') === 0 and $val != null) {
                  echo "<td><img alt='Foto de la actividad' src='", "/wp-content/uploads/fotos_actividades/".$val, "'></td>";
                }
                elseif(strcmp($key, 'actividad_id') !== 0) echo "<td>", $val, "</td>";
            }
            echo '<td><a href="?action=actividades&proceso=modificar&id=', $row['actividad_id'], '"><button class="button">Modificar</button></a><br/>';
            echo '<a href="?action=actividades&proceso=borrar&id=', $row['actividad_id'], '"><button class="button borrar">Borrar</button></a></td>';
            print "</tr>";
        }
        print "</tbody></table>";
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