<?php
require_once 'models/category.php';
//require_once 'models/post.php';

class categoryController{
	
	public function index(){
		Utils::isAdmin();
		$category = new Category();
		$categories = $category->getAll();
		
		require_once 'views/category/index.php';
	}
	
	public function ver(){
		if(isset($_GET['id'])){
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
	
	public function create(){
		Utils::isAdmin();
		require_once 'views/category/create.php';
	}
	
	public function save(){
		Utils::isAdmin();
	    if(isset($_POST) && isset($_POST['category_name'])){
			// Guardar la categoria en bd
			$category = new Category();
			$category->setCategory_name($_POST['category_name']);
			$save = $category->save();
		}
		header("Location:".base_url."category/index");
	}
	
}