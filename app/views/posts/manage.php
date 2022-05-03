<h1>Gestión de productos</h1>

<a href="<?=base_url?>posts/create" class="button button-small">
	Nueva Entrada
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
	
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
	
<table>
	<tr>
		<th>ID</th>
		<th>Categoría</th>
		<th>Título</th>
		<th>Contenido</th>
		<th>ACCIONES</th>
	</tr>
	<?php while($pos = $post->fetch_object()): ?>
		<tr>
			<td><?=$pos->id;?></td>
			<td><?=$pos->category_id;?></td>
			<td><?=$pos->title;?></td>
			<td><?=$pos->content;?></td>
			<td>
				<a href="<?=base_url?>posts/editar&id=<?=$pos->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>posts/eliminar&id=<?=$pos->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
