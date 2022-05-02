<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Tienda de Camisetas</title>
		<link rel="stylesheet" href="<?=base_url?>../public/css/styles.css" />
	</head>
	<body>
		<div id="container">
			<!-- CABECERA -->
			<header id="header">
				<div id="logo">
					<img src="assets/img/camiseta.png" alt="Camiseta Logo" />
					<a href="index.php">
						Tienda de camisetas
					</a>
				</div>
			</header>

			<!-- MENU -->
			<?php $categories = Utils::showCategories(); ?>
			<nav id="menu">
				<ul>
					<li>
						<a href="#">Inicio</a>
					</li>
					<?php while($cat = $categories->fetch_object()): ?>
						<li>
							<a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->category_name?></a>
						</li>
					<?php endwhile; ?>
				</ul>
			</nav>

			<div id="content">