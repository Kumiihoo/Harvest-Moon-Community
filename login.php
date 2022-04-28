<?php

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: login.php');
    }

    require "db.php";

    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $records = $conexion->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';
        if (is_countable($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: index.php');
        } else {
            $message = 'Los credenciales no son correctos';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad Harvest Moon ES | Log in</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    <?php if (!empty ($message)): ?>
        <p><?= $message?></p>
    <?php endif; ?>
    </header>
    <section>
        <div class="register-box">
            <img class="avatar" src="img/harvest-moon-back-to-nature-png-5.png" alt="pete icon">
            <h1>Acceso a la Comunidad <br>de Harvest Moon ES</h1>
            <form action="login.php" method="post">
                <label >Nombre de Usuario</label>
                <input type="text" name="email" placeholder="Nombre de Usuario">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña">
                <input type="submit" value="Entrar">
                <a href="signup.php">¿Aún no tienes cuenta?</a>
            </form>
        </div>
    </section>
    <footer></footer>
</body>
</html>