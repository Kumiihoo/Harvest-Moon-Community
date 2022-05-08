<?php

class Category
{
	private $id;
	private $category_name;
	private $db;

	public function __construct()
	{
		$this->db = Database::connect();
	}

	function getId()
	{
		return $this->id;
	}

	function getCategory_name()
	{
		return $this->category_name;
	}

	function setId($id)
	{
		$this->id = $id;
	}

	function setCategory_name($category_name)
	{
		$this->category_name = $this->db->real_escape_string($category_name);
	}

	public function getAll()
	{
		$categorias = $this->db->query("SELECT * FROM categories ORDER BY id ASC;");
		return $categorias;
	}

	public function getOne()
	{
		$categoria = $this->db->query("SELECT * FROM categories WHERE id={$this->getId()}");
		return $categoria->fetch_object();
	}

	public function save()
	{
		$sql = "INSERT INTO categories VALUES(NULL, '{$this->getCategory_name()}');";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;
	}

	public function update()
	{
		$sql = "UPDATE categories SET category_name = '{$this->getCategory_name()}' WHERE id = {$this->getId()}";
		$succ = $this->db->query($sql);

		return $succ;
	}

	public function getOneById($id)
	{
		$sql = "SELECT * FROM categories WHERE id = {$id}";
		$post = $this->db->query($sql);
		return $post;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM categories WHERE id = {$id} LIMIT 1";
		$succ = $this->db->query($sql);
		return $succ;
	}
}
