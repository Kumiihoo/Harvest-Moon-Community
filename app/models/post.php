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
}