<?php
require "db.php";

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Has creado un usuario';
    } else {
        $message = 'No se ha podido crear el usuario';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad Harvest Moon ES | Sign Up</title>
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header></header>

    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    <section>
        <div class="register-box">
            <img class="avatar" src="public/img/harvest-moon-back-to-nature-png-5.png" alt="pete icon">
            <h1>Registro a la Comunidad <br>de Harvest Moon ES</h1>
            <form action="signup.php" method="POST">
                <label>Email</label>
                <input type="email" name="email" placeholder="pete@harvestmoon.es">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" placeholder="Máximo 12 carácteres simples">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Mínimo de un símbolo y un número entre X - Y carácteres">
                <label>Confirmación Contraseña</label>
                <input type="password" placeholder="Escribe de nuevo la Contraseña">
                <input type="submit" value="Confirmar">
                <a href="login.php">¿Ya tienes una cuenta?</a>
            </form>
        </div>
    </section>
    <footer></footer>
</body>

</html>