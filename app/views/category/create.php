<h1>Crear nueva categoria</h1>

<form action="<?=base_url?>category/save" method="POST">
	<label for="category_name">Nombre</label>
	<input type="text" name="category_name" required/>
	
	<input type="submit" value="Guardar" />
</form>