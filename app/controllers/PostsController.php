<?php
require_once 'models/post.php';

class postsController
{

    public function index()
    {
        $post = new Post();
        $posts = $post->getIndex(4); //limite de posts que se mostrarán

        require_once 'views/posts/latest.php';
    }

    public function manage()
    {
        Utils::isAdmin();

        $post = new Post();
        if (isset($_SESSION['admin'])) {
            $post = $post->getAll();
        } else if (isset($_SESSION['identity']) && $_SESSION['identity']->id) {
            $author_id = $_SESSION['identity']->id;
            $post = $post->getPostsByUid($author_id);
        }

        $cat_array = array();
        $categories = (new Category())->getAll();
        while ($cat = $categories->fetch_object()) {
            $cat_array[$cat->id] = $cat->category_name;
        }

        $user_array = array();
        $users = (new User())->getAll();
        while ($user = $users->fetch_object()) {
            $user_array[$user->id] = $user->username;
        }

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
            $category = isset($_POST['category_id']) ? $_POST['category_id'] : false;

            $author_id = isset($_SESSION['identity']) ? $_SESSION['identity']->id : false;
            if (!$author_id) {
            }

            if ($title && $content && $category) {
                $post = new Post();
                $post->setTitle($title);
                $post->setContent($content);
                $post->setCategory_id($category);
                $post->setAuthor($author_id);

                $filename = $this->handleUploadPicture();
                if ($filename) {
                    $post->setPicture($filename);
                }

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

    public function editar()
    {
        Utils::isAdmin();

        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $post_id = isset($queries['id']) ? $queries['id'] : 0;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $this->fillPost();
            $post_id = $post->getId();
            if (!$post) {
            }
            $succ = $post->updatePostContent();
            if (!$succ) {
            }
            header('Location:' . base_url . 'posts/manage');
        }

        $result = (new Post())->getOneById($post_id);
        $pos = $result->fetch_array();

        require_once 'views/posts/editar.php';
    }

    private function handleUploadPicture()
    {
        if (isset($_FILES['picture'])) {
            $file = $_FILES['picture'];
            $filename = $file['name'];
            $mimetype = $file['type'];

            if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                if (!is_dir('uploads/images')) {
                    mkdir('uploads/images', 0777, true);
                }
                move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
            }

            return $filename;
        }

        return null;
    }

    private function fillPost()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $title = isset($_POST['title']) ? $_POST['title'] : false;
        $content = isset($_POST['content']) ? $_POST['content'] : false;
        $category = isset($_POST['category_id']) ? $_POST['category_id'] : false;
        $author_id = isset($_SESSION['identity']) ? $_SESSION['identity']->id : false;
        if (!$author_id) {
        }
        $filename = $this->handleUploadPicture();

        $post = new Post();
        $post->setId($id);
        $post->setTitle($title);
        $post->setContent($content);
        $post->setCategory_id($category);
        $post->setAuthor($author_id);
        if ($filename) {
            $post->setPicture($filename);
        }

        return $post;
    }

    public function eliminar()
    {
        Utils::isAdmin();

        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $id = isset($queries["id"]) ? $queries["id"] : 0;
        if (!$id) {
            throw new Exception("Error Processing Request", 1);
        }

        $uid = Utils::getUserId();

        $post = new Post();
        $succ = $post->delete($id, $uid);
        if (!$succ) {
            throw new Exception("", 2);
        }

        header('Location:' . base_url . 'posts/manage');
        return;
    }

    public function detail()
    {
        Utils::isAdmin();

        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $post_id = isset($queries["id"]) ? $queries["id"] : 0;
        if (!$post_id) {
            throw new Exception("Error Processing Request", 1);
        }

        $result = (new Post())->getOneById($post_id);
        $post = $result->fetch_object();

        require_once 'views/posts/detail.php';
    }
}
