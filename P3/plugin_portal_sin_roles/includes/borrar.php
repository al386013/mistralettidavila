<?php
/**
* @title: P2 PHP borrar.php
* @author Jorge Davila <al386179@uji.es> 
* Melani Mistraletti <al386013@uji.es>
* @copyright 2021 ATSD
* @license CC-BY-NC-SA
*/

include("gestion_BD.php");
borrar($pdo,$table,$_REQUEST['id']);
include("listar.php");

?>