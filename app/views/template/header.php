<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Comunidad Harvest Moon ES</title>
	<link rel="stylesheet" href="<?= base_url ?>../public/css/styles.css" />
	<script src="https://kit.fontawesome.com/bb9f5d76e2.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
	<div id="container">

		<header id="header">
			<div id="logo">
				<img src="/Harvest-Moon-Community/public/img/HarvestMoonSNES.webp" alt="Harvest Moon Logo" />
				<a href="index.php">
					Comunidad Harvest Moon & Story Of Seasons ES
				</a>
			</div>
		</header>


		<?php $categories = Utils::showCategories(); ?>
		<nav id="menu">
			<ul>
				<li>
					<a href="<?= base_url ?>">Inicio</a>
				</li>
				<?php while ($cat = $categories->fetch_object()) : ?>
					<li>
						<a href="<?= base_url ?>category/filter&id=<?= $cat->id ?>"><?= $cat->category_name ?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		</nav>

		<div id="content">