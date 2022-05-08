<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Comunidad Harvest Moon ES</title>
	<link rel="stylesheet" href="<?= base_url ?>../public/css/styles.css" />
	<script src="https://kit.fontawesome.com/bb9f5d76e2.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
</head>

<body>
	<div id="container">
		<!-- CABECERA -->
		<header id="header">
			<div id="logo">
				<img src="/Harvest-Moon-Community/public/img/HarvestMoonSNES.webp" alt="Harvest Moon Logo" />
				<a href="index.php">
					Comunidad Harvest Moon & Story Of Seasons ES
				</a>
			</div>
		</header>

		<!-- MENU -->
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