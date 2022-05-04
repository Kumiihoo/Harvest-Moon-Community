<?php

class Utils{
	
	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		
		return $name;
	}

	public static function isAdmin(){
		if(!isset($_SESSION['admin'])){
			 header("Location:".base_url);
		}else{
			return true;
		}

		return false;
	}

	public static function showCategories(){
		require_once 'models/category.php';
		$category = new Category();
		$categories = $category->getAll();
		return $categories;
	}

	public static function showCategory($id){
		require_once 'models/category.php';
		$category = new Category();
		$category->setId($id);
		$category = $category->getOne();
		return $category;
	}

	public static function getUserId() {
		if (isset($_SESSION['identity']) && $_SESSION['identity']->id) {
			return $_SESSION['identity']->id;
		}

		return false;
	}
}

