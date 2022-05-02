<?php

class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'harvestmoon'); //Parámetros de Entrada a la base de datos
		$db->query("SET NAMES 'utf8'"); //Devuelve carácteres extraños en Español
		return $db;
	}
}
