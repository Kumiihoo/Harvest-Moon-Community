<?php
require_once 'models/user.php';


class usersController
{

    public function index()
    {
        echo "Controlador Usuarios, Acción Index";
    }

    public function signup()
    {
        require_once 'views/user/signup.php';
    }

    public function save()
    {
        if (isset($_POST)) {
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($username && $email && $password) {
                $user = new User();
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($password);

                $save = $user->save();
                if ($save) {
                    $_SESSION['signup'] = "complete";
                } else {
                    $_SESSION['signup'] = "failed";
                }
            } else {
                $_SESSION['singup'] = "failed";
            }
        } else {
            $_SESSION['signup'] = "failed";
        }
        header("Location:" . base_url . 'users/signup');
    }

    public function login()
    {
        if (isset($_POST)) {
            // Identificar al usuario
            // Consulta a la base de datos
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);

            $identity = $user->login();

            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->role == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Identificación fallida !!';
            }
        }
        header("Location:" . base_url);
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header("Location:" . base_url);
    }

    public function profile()
    {
        $uid = isset($_SESSION['identity']) ? $_SESSION['identity']->id : false;
        if (!$uid) {
        }

        $profile = (new User())->getUserById($uid);

        require_once 'views/user/profile.php';
    }

    public function updateprofile()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $username = isset($_POST['username']) ? $_POST['username'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;

            $user = new User();
            $user->setId($id);
            $user->setUsername($username);
            $user->setEmail($email);

            $result = $user->update();
            if (!$result) {
                // error
                header("Location:" . base_url);
            }

            if (isset($_SESSION['identity'])) {
                unset($_SESSION['identity']);
            }

            if (isset($_SESSION['admin'])) {
                unset($_SESSION['admin']);
            }
        }

        header("Location:" . base_url);
    }
}
