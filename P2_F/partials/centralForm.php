<main>
	<h1>Gestión de Actividades </h1>
	<details>
		<summary>¿Qué debo hacer?</summary>
		<p id="info">Registre las actividades de la asociación indicando sus principales características.</p>
	</details>

	<form class="fom_usuario" action="?action=<?php echo $_REQUEST['id'] > 0 ? 'modificar2' : 'registrar'; ?>" method="POST">
		<input type="hidden" name="id"value="<?php print ($_REQUEST['id'] )?>"/>

		<legend>Registro de una actividad</legend>
		<label for="nombre">Nombre (*)</label>
		<br/>
		<input type="text" name="nombre" class="item_requerid" maxlength="50" value="<?php print $nombre ?>"
		 placeholder="Actividad1" required/>
		<br/>
		<label for="descripcion">Descripción</label>
		<br/>
		<input type="text" name="descripcion" class="item_requerid" maxlength="250" value="<?php print $descripcion ?>"
		 placeholder="Descripción de la actividad" />
		<br/>
		<label for="localizacion">Localización (*)</label>
		<br/>
		<input type="text" name="localizacion" class="item_requerid" maxlength="50" value="<?php print $localizacion ?>"
		 placeholder="Localización de la actividad" required/>
		<br/>
		<label for="fecha">Día de la actividad (*)</label>
		<br/>
		<input type="date" name="fecha" value="<?php print $fecha ?>" required/>	
		<br/>
		<label for="hora">Hora de inicio (*)</label>
		<br/>
		<input type="time" name="hora" value="<?php print $hora?>" required/>
		<br/>
		<input class="btn" type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
		<br/>
	</form>
</main>