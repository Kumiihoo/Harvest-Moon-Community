				<!-- BARRA LATERAL -->
				<aside id="lateral">

					<div id="login" class="block_aside">
						<?php if (!isset($_SESSION['identity'])) : ?>
							<h3>Entrar a la web</h3>
							<form action="<?= base_url ?>users/login" method="post">
								<label for="email">Email</label>
								<input type="email" name="email" />
								<label for="password">Contraseña</label>
								<input type="password" name="password" />
								<input type="submit" value="Enviar" />
							</form>
						<?php else : ?>
							<h3><?= $_SESSION['identity']->email ?></h3>
						<?php endif; ?>
						<ul>
							<?php if (isset($_SESSION['admin'])) : ?>
								<li><a href="<?= base_url ?>category/index">Gestionar categorias</a></li>
								<li><a href="<?= base_url ?>posts/manage">Gestionar Posts</a></li>
								<li><a href="<?= base_url ?>pedido/gestion">Gestionar pedidos</a></li>
							<?php endif; ?>

							<?php if (isset($_SESSION['identity'])) : ?>
								<li><a href="<?= base_url ?>pedido/mis_pedidos">Mis pedidos</a></li>
								<li><a href="<?= base_url ?>users/logout">Cerrar sesión</a></li>
							<?php else : ?>
								<li><a href="<?= base_url ?>users/signup">Registrate aquí</a></li>
							<?php endif; ?>
						</ul>

				</aside>

				<!-- CONTENIDO CENTRAL -->
				<div id="central">