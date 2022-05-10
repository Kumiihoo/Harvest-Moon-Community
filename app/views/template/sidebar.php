<aside id="lateral">

	<div id="login" class="block_aside">
		<?php if (!isset($_SESSION['identity'])) : ?>
			<h3>Iniciar sesión</h3>
			<form action="<?= base_url ?>users/login" method="post">
				<label for="email">Correo Electrónico</label>
				<input type="email" name="email" />
				<label for="password">Contraseña</label>
				<input type="password" name="password" />
				<input type="submit" class="confirmacion" value="Entrar" />
			</form>
		<?php else : ?>
			<h3>Bienvenido de nuevo, <?= $_SESSION['identity']->username ?></h3>
		<?php endif; ?>
		<ul>
			<?php if (isset($_SESSION['admin'])) : ?>
				<li><a href="<?= base_url ?>category/index">Administrar Categorías</a></li>
				<li><a href="<?= base_url ?>posts/manage">Administrar Posts</a></li>
			<?php endif; ?>

			<?php if (isset($_SESSION['identity'])) : ?>
				<li><a href="<?= base_url ?>posts/manage">Mis Posts</a></li>
				<li><a href="<?= base_url ?>users/profile">Editar Perfil</a></li>
				<li><a href="<?= base_url ?>users/logout">Cerrar sesión</a></li>
			<?php else : ?>
				<li><a href="<?= base_url ?>users/signup">¿Aún no tienes cuenta?</a></li>
			<?php endif; ?>
		</ul>

</aside>


<div id="central">