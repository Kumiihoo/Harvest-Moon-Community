<h1>Panel de Administración de Categorías</h1>

<a href="<?=base_url?>category/create" class="button button-small">
	Nueva Categoría
</a>

<table>
	<tr>
		<th>ID</th>
		<th>Nombre de la Categoría</th>
	</tr>
	<?php while($cat = $categories->fetch_object()): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->category_name;?></td>
			<td>
				<a href="<?=base_url?>category/editar&id=<?=$cat->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>category/eliminar&id=<?=$cat->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
