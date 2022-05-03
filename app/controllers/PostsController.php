<?php
require_once 'models/post.php';

class postsController
{

    public function index()
    {
        //se muestra la vista

        require_once 'views/posts/latest.php';
    }

    public function manage()
    {
        Utils::isAdmin();

        $post = new Post(); //TODO CAMBIAR NOMBRE OBJETO
        $posts = $post->getAll();

        require_once 'views/posts/manage.php';
    }

    public function create()
    {
        Utils::isAdmin();
        require_once 'views/posts/create.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $title = isset($_POST['title']) ? $_POST['title'] : false;
            $content = isset($_POST['content']) ? $_POST['content'] : false;
            $category = isset($_POST['category_id']) ? $_POST['category_id'] : false; //FIXME: PROBAR CON CATEGORY_NAME
            //$picture = isset($_POST['picture']) ? $_POST['picture'] : false;

            $author_id = isset($_SESSION['identity']) ? $_SESSION['identity']->id : false;
            if (! $author_id) {
                // TODO some info & return
            }

            if ($title && $content && $category) {
                $post = new Post();
                $post->setTitle($title);
                $post->setContent($content);
                $post->setCategory_id($category);
                $post->setAuthor($author_id);

                $save = $post->save();
                if ($save) {
                    $_SESSION['post'] = "complete";
                } else {
                    $_SESSION['post'] = "failed";
                }
            } else {
                $_SESSION['post'] = "failed";
            }
        } else {
            $_SESSION['post'] = "failed";
        }
        header('Location:' . base_url . 'posts/manage');
    }
}
