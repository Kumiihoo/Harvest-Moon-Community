<h1>Crear nueva categoría</h1>

<form action="<?=base_url?>category/save" method="POST">
	<label for="category_name">Nombre de la nueva Categoría</label>
	<input type="text" name="category_name" required/>
	
	<input type="submit" value="Guardar" />
</form>