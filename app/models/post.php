<?php
require_once 'user.php';

class Post
{
	private $id;
	private $category_id;
	private $author;
	private $title;
	private $content;
	private $date;
	private $picture;
	private $db;

	public function __construct()
	{
		$this->db = Database::connect();
	}

	function getId()
	{
		return $this->id;
	}

	function getCategory_id()
	{
		return $this->category_id;
	}

	function getAuthor()
	{
		return $this->author;
	}

	function getTitle()
	{
		return $this->title;
	}

	function getContent()
	{
		return $this->content;
	}

	function getDate()
	{
		return $this->date;
	}

	function getPicture()
	{
		return $this->picture;
	}

	function setId($id)
	{
		$this->id = $id;
	}

	function setCategory_id($category_id)
	{
		$this->category_id = $category_id;
	}

	function setAuthor($author)
	{
		$this->author = $author;
	}

	function setTitle($title)
	{
		$this->title = $this->db->real_escape_string($title);
	}

	function setContent($content)
	{
		$this->content = $this->db->real_escape_string($content);
	}

	function setDate($date)
	{
		$this->date = $this->db->real_escape_string($date);
	}

	function setPicture($picture)
	{
		$this->picture = $picture;
	}

	public function getAll()
	{
		$posts = $this->db->query("SELECT * FROM posts ORDER BY id DESC");
		return $posts;
	}

<<<<<<< HEAD
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
=======
	public function getPostsByUid($uid)
	{
		$sql = "SELECT * FROM posts WHERE `author` = {$uid} ORDER BY id DESC";
		$posts = $this->db->query($sql);
		return $posts;
	}

	public function getIndex($limit)
	{
		$post = $this->db->query("SELECT * FROM posts ORDER BY RAND() LIMIT $limit");
		return $post;
	}

	public function getOneById($id)
	{
		$sql = "SELECT * FROM posts WHERE id = {$id}";
		$post = $this->db->query($sql);
		return $post;
	}

	public function save()
	{
>>>>>>> fix-post
		$sql = "INSERT INTO posts VALUES(NULL, {$this->getCategory_id()}, {$this->getAuthor()}, '{$this->getTitle()}', '{$this->getContent()}', CURDATE(), '{$this->getPicture()}');";

		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}

<<<<<<< HEAD
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
=======
	public function update()
	{
		$sql = "UPDATE posts SET category_id={$this->getCategory_id()}, author = '{$this->getAuthor()}', title = '{$this->getTitle()}', content = '{$this->getContent()}' WHERE id = {$this->getId()}";
		$succ = $this->db->query($sql);

		return $succ;
	}

	public function updatePostContent()
	{
		$user = (new User())->getUserById($this->getAuthor());

		if (!$user) {
			return false;
		}

		$sql = "UPDATE posts SET category_id={$this->getCategory_id()}, title = '{$this->getTitle()}', content = '{$this->getContent()}'";
		if ($this->getPicture()) {
			$sql = $sql . ", picture = '{$this->getPicture()}'";
		}

		if ($user['role'] == 'admin') {
			$sql = $sql . " WHERE id = {$this->getId()} LIMIT 1";
		} else {
			$sql = $sql . " WHERE id = {$this->getId()} AND author = {$this->getAuthor()} LIMIT 1";
		}

		$succ = $this->db->query($sql);

		return $succ;
	}

	public function delete($id, $authorId)
	{
		$user = (new User())->getUserById($authorId);

		if (!$user) {
			return false;
		}

		if ($user['role'] == 'admin') {
			$sql = "DELETE FROM posts WHERE id = {$id} LIMIT 1";
		} else {
			$sql = "DELETE FROM posts WHERE id = {$id} AND author = {$authorId} LIMIT 1";
		}

		$succ = $this->db->query($sql);
		return $succ;
	}

	public function queryByCategory($category_id, $page, $limit)
	{
		$offset = 0;
		if ($page && $limit) {
			$offset = $page * $limit;
		}

		$sql = "SELECT * FROM posts WHERE category_id = {$category_id} ORDER BY id DESC LIMIT {$limit} OFFSET {$offset}";

		error_log("{$sql}");
		$posts = $this->db->query($sql);
		return $posts;
	}
}
>>>>>>> fix-post
