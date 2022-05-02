<h1>Gestionar categorias</h1>

<a href="<?=base_url?>category/create" class="button button-small">
	Crear categoría
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
	</tr>
	<?php while($cat = $categories->fetch_object()): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->category_name;?></td>
		</tr>
	<?php endwhile; ?>
</table>
