//include("template/header.php");

<?php
    session_start();
    require 'db.php';

    if (isset($_SESSION['user_id'])){
        $records = $conexion->prepare('SELECT id, email, password FROM users WHERE  id=:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (is_countable($results) > 0) {
            $user = $results;
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>
    <?php if(!empty($user)): ?>
        <br> Welcome. <?= $user['email'] ?>
        <a href="logout.php">Log Out</a>
    <?php else: ?>
        <h1>Please Login or SingUp </h1>
        <a href="signup.php">Sign up</a>
        <a href="login.php">Log In</a>
    <?php endif; ?>
    

//include("template/footer.php");