<h1>Crear nueva Entrada</h1>
<?php $url_action = base_url . "posts/save"; ?>

<div class="form_container">

	<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
		<label for="title">Título de la Entrada</label>
		<input type="text" name="title" required value="<?= isset($pos) && is_object($pos) ? $pos->title : ''; ?>" />

		<label for="content">Contenido de la Entrada</label>
		<textarea name="content" required><?= isset($pos) && is_object($pos) ? $pos->content : ''; ?></textarea>
		<label for="category_id">Categoría</label>
		<?php $categories = Utils::showCategories(); ?>
		<select name="category_id" required>
			<?php while ($cat = $categories->fetch_object()) : ?>
				<option value="<?= $cat->id ?>">
					<?= $cat->category_name ?>
				</option>
			<?php endwhile; ?>
		</select>
		<label for="picture">Imagen</label>

		<input type="file" name="picture" />

		<input type="submit" class="confirmacion" value="Guardar" />
	</form>
</div>