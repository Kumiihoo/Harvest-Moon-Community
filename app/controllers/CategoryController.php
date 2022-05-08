<?php
require_once 'models/category.php';
require_once 'models/post.php';
//require_once 'models/post.php';

class categoryController
{

    public function index()
    {
        Utils::isAdmin(true);
        $category = new Category();
        $categories = $category->getAll();

        require_once 'views/category/index.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Conseguir categoria
            $category = new Category();
            $category->setId($id);
            $category = $category->getOne();

            // Conseguir productos;
            //$post = new Post();
            //$post->setCategoria_id($id);
            //$posts = $post->getAllCategory();
        }

        require_once 'views/category/readmore.php';
    }

    public function create()
    {
        Utils::isAdmin();
        require_once 'views/category/create.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['category_name'])) {
            // Guardar la categoria en bd
            $category = new Category();
            $category->setCategory_name($_POST['category_name']);
            $save = $category->save();
        }
        header("Location:" . base_url . "category/index");
    }

    public function editar()
    {
        Utils::isAdmin();

        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $cat_id = isset($queries['id']) ? $queries['id'] : 0;
        // POST to submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category = $this->fillCategory();
            $cat_id = $category->getId();
            if (!$category) {
            }
            $succ = $category->update();
            if (!$succ) {
            }
            header('Location:' . base_url . 'category/index');
        }

        $result = (new Category())->getOneById($cat_id);
        $pos = $result->fetch_array();
        require_once 'views/category/editar.php';
    }

    private function fillCategory()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $name = isset($_POST['category_name']) ? $_POST['category_name'] : false;

        $cat = new Category();
        $cat->setId($id);
        $cat->setCategory_name($name);

        return $cat;
    }

    public function eliminar()
    {
        Utils::isAdmin();
        // error_log("get {$_GET}");
        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $id = isset($queries["id"]) ? $queries["id"] : 0;
        if (!$id) {
            throw new Exception("Error Processing Request", 1);
        }
        $succ = (new Category())->delete($id);
        if (!$succ) {
            throw new Exception("delete catogory error", 2);
        }

        header("Location:" . base_url . "category/index");
    }

    public function filter()
    {

        $queries = array();
        parse_str($_SERVER['REQUEST_URI'], $queries);

        $id = isset($queries["id"]) ? $queries["id"] : 0;

        // query category
        $cat_result = (new Category())->getOneById($id);
        $category = $cat_result->fetch_array();

        // prepare to query posts
        $page = 0;
        $limit = 10;

        error_log("id {$id} page {$page}");
        $posts = (new Post())->queryByCategory($id, $page, $limit);

        require_once 'views/category/filter.php';
    }
}
