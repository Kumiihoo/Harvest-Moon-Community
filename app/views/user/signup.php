<h1>Registro a la Comunidad <br>de Harvest Moon ES</h1>

<?php if (isset($_SESSION['signup']) && $_SESSION['signup'] == 'complete') : ?>
    <strong>Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['signup']) && $_SESSION['signup'] == 'failed') : ?>
    <strong>Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('signup'); ?>

<form action="<?=base_url?>users/save" method="POST">
    <label for="email"><i class="fa-solid fa-at"></i> Correo Electrónico</label>
    <input type="email" name="email" placeholder="pete@harvestmoon.es" required>
    <label for="username"><i class="fa-solid fa-user"></i> Nombre de Usuario</label>
    <input type="text" name="username" placeholder="Máximo 12 carácteres simples" required>
    <label for="password"> <i class="fa-solid fa-lock"></i> Contraseña</label>
    <input type="password" name="password" placeholder="Mínimo de un símbolo y un número entre X - Y carácteres" required>
    <input type="submit" class="confirmacion" value="Confirmar"> <br>
    <a href="login.php" id="registro">¿Ya tienes cuenta?</a>
</form>
</form>