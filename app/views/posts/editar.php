
	<h1>Crear nueva Entrada</h1>
	<?php $url_action = base_url . "posts/editar"; ?>

<div class="form_container">

	<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$pos['id'] ?>" />
		<label for="title">Título de la Entrada</label>
		<input type="text" name="title" value="<?= $pos['title']; ?>" />

		<label for="content">Contenido de la Entrada</label>
		<textarea name="content"><?= $pos['content'] ?></textarea>

		<!--TODO: PONER QUIÉN VA A SER EL AUTOR-->

		<label for="category_id">Categoría</label>
		<?php $categories = Utils::showCategories(); ?>
		<select name="category_id">
			<?php while ($cat = $categories->fetch_object()) : ?>
				<option value="<?=$cat->id?>"
                    <?= $cat->id == $pos['category_id'] ? "selected":"";?>
                >
					<?=$cat->category_name?>
				</option>
			<?php endwhile; ?>
		</select>
		<label for="picture">Imagen</label>

		<input type="file" name="picture" />

		<input type="submit" class="confirmacion" value="Guardar" />
	</form>
</div>