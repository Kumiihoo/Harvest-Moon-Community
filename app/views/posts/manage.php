<h1>Gestión de posts</h1>

<a href="<?=base_url?>posts/create" class="button button-small">
	Nueva Entrada
</a>

<?php if(isset($_SESSION['post']) && $_SESSION['post'] == 'complete'): ?>
	<strong class="alert_green">El post se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['post']) && $_SESSION['post'] != 'complete'): ?>	
	<strong class="alert_red">El post NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('post'); ?>
	
<?php if(isset($_SESSION['erase']) && $_SESSION['erase'] == 'complete'): ?>
	<strong class="alert_green">El post se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['erase']) && $_SESSION['erase'] != 'complete'): ?>	
	<strong class="alert_red">El post NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('erase'); ?>
	
<table>
	<tr>
		<th>ID</th>
		<th>Categoría</th>
		<th>Título</th>
		<th>Contenido</th>
		<th>ACCIONES</th>
	</tr>
	<?php while($pos = $posts->fetch_object()): ?>
		<tr>
			<td><?=$pos->id;?></td>
			<td><?=$pos->category_id;?></td>
			<td><?=$pos->title;?></td>
			<td><?=$pos->content;?></td>
			<td>
				<a href="<?=base_url?>posts/edit&id=<?=$pos->id?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>posts/erase&id=<?=$pos->id?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
