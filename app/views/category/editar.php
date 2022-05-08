<h1>Crear nueva categoria</h1>

<form action="<?=base_url?>category/editar" method="POST">
<input type="hidden" name="id" value="<?= $pos['id']; ?>" />
	<label for="category_name">Nombre</label>
	<input type="text" name="category_name" 
		value="<?= $pos['category_name']; ?>" required/>
	
	<input type="submit" class="confirmacion" value="Guardar" />
</form>