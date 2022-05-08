<h1>Algunos de nuestros posts</h1>

<?php while ($post = $posts->fetch_array()) : ?>
	<div class="posts">
		<a href="<?= base_url ?>posts/detail&id=<?= $post['id'] ?>">
			<?php if ($post['picture'] != null) : ?>
				<img src="<?= base_url ?>uploads/images/<?= $post['picture'] ?>" />
			<?php else : ?>
				<img src="<?= base_url ?>../public/img/sustituto.png" />
			<?php endif; ?>
			<div class="marco">
				<h2><?= $post['title'] ?></h2>
			</div>
		</a>
		<p><?= $post['content'] ?></p>
		<a href="<?= base_url ?>posts/detail&id=<?= $post['id'] ?>" class="button">Leer Más</a>
	</div>
<?php endwhile; ?>