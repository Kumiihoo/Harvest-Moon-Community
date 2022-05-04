<?php if (isset($post)): ?>
	<h1><?= $post->title ?></h1>
	<div id="detail-post">
		<div class="image">
			<?php if ($post->picture != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $post->picture ?>" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="content"><?= $post->content ?></p>
			<p class="date"><?= $post->date ?>$</p>
			<a href="<?=base_url?>carrito/add&id=<?=$post->id?>" class="button">Volver</a>
		</div>
	</div>
<?php else: ?>
	<h1>Este post no existe</h1>
<?php endif; ?>
