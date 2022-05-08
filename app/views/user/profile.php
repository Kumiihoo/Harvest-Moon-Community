<h1>Datos de tu cuenta</h1>

<form action="<?=base_url?>users/updateprofile" method="POST">
    <input type="hidden" name="id" placeholder="0" value="<?= $profile['id']; ?>">
    <label for="email">Correo Electrónico</label>
    <input type="email" name="email" value="<?= $profile['email']; ?>" placeholder="pete@harvestmoon.es">
    <label for="username">Nombre de Usuario</label>
    <input type="text" name="username" value="<?= $profile['username']; ?>" placeholder="Máximo 12 carácteres simples">
    <input type="submit" value="Cambiar">
</form>