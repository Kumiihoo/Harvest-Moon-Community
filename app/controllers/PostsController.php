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

                if(isset($_FILES['picture'])){
					$file = $_FILES['picture'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/images')){
							mkdir('uploads/images', 0777, true);
						}

						$post->setPicture($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
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
    
    public function editar() {
        Utils::isAdmin();

        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $post_id = isset($queries['id']) ? $queries['id'] : 0;
        // POST to submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $this->fillPost();
            $post_id = $post->getId();
            if (! $post) { // TODO handle error

            }
            $succ = $post->update();
            if (! $succ) {// TODO handle error

            }
            header('Location:'.base_url.'posts/manage');
        }

        $result = (new Post())->getOneById($post_id);
        $pos = $result->fetch_array();
        // error_log("{$result->num_rows}, {$pos['title']}");
        require_once 'views/posts/editar.php';
    }

    private function fillPost() {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $title = isset($_POST['title']) ? $_POST['title'] : false;
        $content = isset($_POST['content']) ? $_POST['content'] : false;
        $category = isset($_POST['category_id']) ? $_POST['category_id'] : false;
        $author_id = isset($_SESSION['identity']) ? $_SESSION['identity']->id : false;
        if (! $author_id) {
            // TODO some info & return
        }

        $post = new Post();
        $post->setId($id);
        $post->setTitle($title);
        $post->setContent($content);
        $post->setCategory_id($category);
        $post->setAuthor($author_id);

        return $post;
    }

    public function eliminar() {
        Utils::isAdmin();
        // error_log("get {$_GET}");
        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);
        
        $id = isset($queries["id"]) ? $queries["id"] : 0;
        if (! $id) {
            throw new Exception("Error Processing Request", 1);
            
        }
        $succ = (new Post())->delete($id);
        if (! $succ) {
            throw new Exception("", 2);
        }





        header('Location:'.base_url.'posts/manage');
        return;
    }
}
