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

        $post = new Post();
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
	
	public function erase(){
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$post = new Post();
			$post->setId($id);
			
			$erase = $post->erase();
			if($erase){
				$_SESSION['erase'] = 'complete';
			}else{
				$_SESSION['erase'] = 'failed';
			}
		}else{
			$_SESSION['erase'] = 'failed';
		}
		
		header('Location:'.base_url.'posts/manage');
	}
}
