<?php
/**
* @title: P3 gestion_BD.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include_once("gestion_BD.php");
include_once(dirname(__FILE__)."/../partials/tabla_js.php");

function coloresJS() {
    // Funcion JS para cambiar el color de la letra en la tabla
    echo '<p id="personalizar" onclick="muestraOculto()">Clica para personalizar la tabla</p>';
    echo '<div id="oculto" class="info"><p>Selecciona un botón para cambiar el color de la letra:</p>';
    echo '<button type="button" class="botonColor" id="rosa" onclick="cambiaColor(\'#FBD9FF\')">Rosa</button>';
    echo '<button type="button" class="botonColor" id="azul" onclick="cambiaColor(\'#A1FFF1\')">Azul</button>';
    echo '<button type="button" class="botonColor" id="verde" onclick="cambiaColor(\'#B1FFA1\')">Verde</button>';
    echo '<button type="button" class="botonColor" id="naranja" onclick="cambiaColor(\'#FFDEA1\')">Naranja</button>';
    echo '<button type="button" class="botonColor" onclick="cambiaColor(\'#EEEEEE\')">Blanco</button></div>';
}

function handler($pdo,$table)
{
    echo '<h1 class="page-title">Gestión de actividades</h1>';
    echo '<div class="entry-meta">Gestiona las actividades de la asociación.</div>';
    echo '<h2 class="titulo-actividades">Listado de actividades</h2>';

    coloresJS(); 

    $rows=consultar($pdo,$table);
    if (is_array($rows) and count($rows) > 0) { /* Creamos un listado como una tabla HTML*/
        print '<table id="tablaLista"><thead>';
        echo "<th>Nombre</th><th>Descripción</th><th>Localización</th><th>Fecha</th><th>Hora</th><th>Usuario</th><th>Acciones</th>";
        print "</thead>";
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
                elseif(strcmp($key, 'actividad_id') !== 0) echo "<td>", $val, "</td>";
                
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