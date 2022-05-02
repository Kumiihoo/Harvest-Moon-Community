<h1>Registro a la Comunidad <br>de Harvest Moon ES</h1>

<?php if (isset($_SESSION['signup']) && $_SESSION['signup'] == 'complete') : ?>
    <strong>Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['signup']) && $_SESSION['signup'] == 'failed') : ?>
    <strong>Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('signup'); ?>

<form action="<?=base_url?>users/save" method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="pete@harvestmoon.es">
    <label for="username">Nombre de Usuario</label>
    <input type="text" name="username" placeholder="Máximo 12 carácteres simples">
    <label for="password">Contraseña</label>
    <input type="password" name="password" placeholder="Mínimo de un símbolo y un número entre X - Y carácteres">
    <label>Confirmación Contraseña</label>
    <input type="password" placeholder="Escribe de nuevo la Contraseña" >
    <input type="submit" value="Confirmar">
    <a href="login.php">¿Ya tienes una cuenta?</a>
</form>
</form>