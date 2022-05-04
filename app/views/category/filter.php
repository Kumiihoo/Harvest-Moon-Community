<?php if (isset($category)): ?>
	<h1><?= $category['category_name'] ?></h1>
	<?php if ($posts->num_rows == 0): ?>
		<p>No hay postos para mostrar</p>
	<?php else: ?>

		<?php while ($post = $posts->fetch_array()): ?>
			<div class="post">
				<a href="<?= base_url ?>post/ver&id=<?= $post['id'] ?>">
					<?php if ($post['picture'] != null): ?>
						<img src="<?= base_url ?>uploads/images/<?= $post['picture'] ?>" />
					<?php else: ?>
						<img src="<?= base_url ?>assets/img/camiseta.png" />
					<?php endif; ?>
					<h2><?= $post['title'] ?></h2>
				</a>
				<p><?= $post['content'] ?></p>
				<a href="<?=base_url?>carrito/add&id=<?=$post['id']?>" class="button">Comprar</a>
			</div>
		<?php endwhile; ?>

	<?php endif; ?>
<?php else: ?>
	<h1>La categoría no existe</h1>
<?php endif; ?>
