<div id="primary" class="content-area">
<main role="main">
        <h1 class="page-title">Gestión de actividades</h1>
        <div class="entry-meta">Gestiona las actividades de la asociación.</div>
	<h1 class="titulo-actividades">
           <?php echo (!is_null($_REQUEST['id']) and $_REQUEST['id'] > 0) ? 'Modificación ' : 'Registro '; ?>
           de actividades</h1>
	<details>
		<summary>¿Qué debo hacer?</summary>
		<p class="info">Rellena los siguientes campos con los datos de una actividad.</p>
	</details>

	<form class="fom_usuario" action="?action=actividades&proceso=<?php echo (!is_null($_REQUEST['id']) and $_REQUEST['id'] > 0) ? 'modificar2' : 'registrar'; ?>" method="POST">
		<input type="hidden" name="id" value="<?php print ($_REQUEST['id'] )?>"/>
		<label for="nombre">Nombre (*)</label>
		<br/>
		<input type="text" name="nombre" id="nombre" class="item_requerid" maxlength="50" value="<?php print $nombre ?>"
		 placeholder="Nombre de la actividad" required/>
		<br/>
		<label for="descripcion">Descripción (*)</label>
		<br/>
		<textarea name="descripcion" id="nombre" class="item_requerid"
		 placeholder="Descripción de la actividad" required/><?php print $descripcion; ?></textarea>
		<br/>
		<label for="localizacion">Localización (*)</label>
		<br/>
		<input type="text" id="localizacion" name="localizacion" class="item_requerid" maxlength="50" value="<?php print $localizacion ?>"
		 placeholder="Localización de la actividad" required/>
		<br/>
		<label for="fecha">Día de la actividad (*)</label>
		<br/>
		<input type="date" id="fecha" name="fecha" value="<?php print $fecha ?>" required/>	
		<br/>
		<label for="hora">Hora de inicio (*)</label>
		<br/>
		<input type="time" id="hora" name="hora" value="<?php print $hora?>" required/>
                <input type="hidden" name="usuario" value="<?php print $usuario ?>"/>
		<br/>
		<input class="btn" type="submit" value="Guardar">
		<input type="reset" value="Resetear">
	</form>
        <div class="cancelar"><a href="?action=actividades&proceso=listar"><button class="button button-cancelar">Cancelar</button></a></div>
</main>
</div>
<?php get_sidebar(); ?>