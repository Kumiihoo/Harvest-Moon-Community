<?php

class Post{
	private $id;
	private $category_id;
	private $author;
	private $title;
	private $content;
	private $date;
	private $picture;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getCategory_id() {
		return $this->category_id;
	}

	function getAuthor() {
		return $this->author;
	}

	function getTitle() {
		return $this->title;
	}

	function getContent() {
		return $this->content;
	}

	function getDate() {
		return $this->date;
	}

	function getPicture() {
		return $this->picture;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCategory_id($category_id) {
		$this->category_id = $category_id;
	}

	function setAuthor($author) {
		$this->author = $author;
	}

	function setTitle($title) {
		$this->title = $this->db->real_escape_string($title);
	}

	function setContent($content) {
		$this->content = $this->db->real_escape_string($content);
	}

	function setDate($date) {
		$this->date = $this->db->real_escape_string($date);
	}

	function setPicture($picture) {
		$this->picture = $picture;
	}

	public function getAll(){
		$posts = $this->db->query("SELECT * FROM posts ORDER BY id DESC");
		return $posts;
	}

	public function getAllCategory(){
		$sql = "SELECT p.*, c.nombre AS 'catnombre' FROM posts p "
				. "INNER JOIN categories c ON c.id = p.category_id "
				. "WHERE p.categoria_id = {$this->getCategory_id()} "
				. "ORDER BY id DESC";
		$productos = $this->db->query($sql);
		return $productos;
	}
	
	public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
		return $productos;
	}
	
	public function getOne(){
		$producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
	}
	
	public function save(){
		$sql = "INSERT INTO posts VALUES(NULL, {$this->getCategory_id()}, {$this->getAuthor()}, '{$this->getTitle()}', '{$this->getContent()}', CURDATE(), '{$this->getPicture()}');";
		error_log($sql);
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function edit(){
		$sql = "UPDATE posts SET nombre='{$this->getTitle()}', descripcion='{$this->getContent()}', category_id={$this->getCategory_id()}  ";
		
		if($this->getPicture() != null){
			$sql .= ", imagen='{$this->getPicture()}'";
		}
		
		$sql .= " WHERE id={$this->id};";
		
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function erase(){
		$sql = "DELETE FROM posts WHERE id={$this->id}";
		$erase = $this->db->query($sql);
		
		$result = false;
		if($erase){
			$result = true;
		}
		return $result;
	}
}