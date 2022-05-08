<h1>Posts Destacados</h1>

<?php while ($post = $posts->fetch_array()) : ?>
	<div class="posts">
		<a href="<?= base_url ?>posts/detail&id=<?= $post['id'] ?>">
			<?php if ($post['picture'] != null) : ?>
				<img src="<?= base_url ?>uploads/images/<?= $post['picture'] ?>" />
			<?php else : ?>
				<img src="<?= base_url ?>../public/img/sustituto.png" />
			<?php endif; ?>
				<h2><?= $post['title'] ?></h2>
		</a>
		<a href="<?= base_url ?>posts/detail&id=<?= $post['id'] ?>" class="button">Leer Más</a>
	</div>
<?php endwhile; ?>