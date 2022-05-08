<h1>Panel de Administración de Posts</h1>

<a href="<?= base_url ?>posts/create" class="button button-small">
	Nueva Entrada
</a>

<?php if (isset($_SESSION['post']) && $_SESSION['post'] == 'complete') : ?>
	<strong class="alert_green">El post se ha creado correctamente</strong>
<?php elseif (isset($_SESSION['post']) && $_SESSION['post'] != 'complete') : ?>
	<strong class="alert_red">El post NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('post'); ?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
	<strong class="alert_green">El post se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete') : ?>
	<strong class="alert_red">El post NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<table>
	<tr>
		<th>ID</th>
		<th>Categoría</th>
		<th>Autor</th>
		<th>Título</th>
		<th>Fecha de Publicación</th>
		<th>Contenido del Post</th>
		<th>ACCIONES</th>
	</tr>
	<?php while ($pos = $post->fetch_object()) : ?>
		<tr>
			<!-- <td><?= $pos->id; ?></td> -->
			<td><a href="<?= base_url ?>posts/detail&id=<?= $pos->id ?>"><?= $pos->id ?></a></td>
			<td><?= $cat_array[$pos->category_id]; ?></td>
			<td><?= $user_array[$pos->author]; ?></td>
			<td><?= $pos->title; ?></td>
			<td><?= $pos->date; ?></td>
			<td><?= $pos->content; ?></td>
			<td>
				<a href="<?= base_url ?>posts/editar&id=<?= $pos->id ?>" class="button button-gestion">Editar</a>
				<a href="<?= base_url ?>posts/eliminar&id=<?= $pos->id ?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>