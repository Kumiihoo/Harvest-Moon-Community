<?php if (isset($post)): ?>
	<h1><?= $post->title ?></h1>
	<div id="detail-post">
		<div class="image">
			<?php if ($post->picture != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $post->picture ?>" />
			<?php else: ?>
				<img src="<?= base_url ?>../public/img/sustituto.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="content"><?= $post->content ?></p>
			<p class="date"><?= $post->date ?></p>
			<?php $category = Utils::showCategory($post->category_id); ?>
			<?php if(isset($category)): ?>
			<a href="<?=base_url?>category/filter&id=<?=$category->id?>" class="button">Volver a <?=$category->category_name?></a>
			<?php endif; ?>
		</div>
	</div>
<?php else: ?>
	<h1>Este post no existe</h1>
<?php endif; ?>
