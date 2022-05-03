<h1>Algunos de nuestros posts</h1>

<?php while ($post = $post->fetch_object()) : ?>
	<div class="post">
		<a href="<?= base_url ?>post/ver&id=<?= $post->id ?>">
			<?php if ($post->picture != null) : ?>
				<img src="<?= base_url ?>uploads/images/<?= $post->picture ?>" />
			<?php else : ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
			<h2><?= $post->title ?></h2>
		</a>
		<p><?= $post->content ?></p>
		<a href="<?= base_url ?>carrito/add&id=<?= $post->id ?>" class="button">Comprar</a>
	</div>
<?php endwhile; ?>