<?php

class DB
{
	private $dbh;
	private $className = 'stdClass';
	
	public function __construct()
	{
		$dbname = 'sectorbi_bu';
		$dbhost = 'localhost';
		$dbuser = 'sectorbi_bu';
		$dbpass = '95965';
		
		$this->dbh = new PDO('mysql:dbname=' . $dbname . ';host=' . $dbhost, $dbuser, $dbpass);
		
	}
	
	public function query($sql, $params = Array())
	{
		$sth = $this->dbh->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
	}
	
	public function execute($sql, $params = Array())
	{
		$sth = $this->dbh->prepare($sql);
		return $sth->execute($params);
	}
	
	public function lastInsetId()
	{
		return $this->dbh->lastInsertId();
	}
	
	/*
	public function queryAll($sql, $params = Array[])
	{
		$result = mysql_query($sql);
		if (false === $result) {
			return false;
		}
		$data = Array();
		while ($row = mysql_fetch_object($result, $class)){
			$data[] = $row;
		}
		return $data;
	}
	*/
	public function setClassName($className)
	{
		$this->className = $className;
	}
	/*
	public function queryOne($sql, $class = )
	{
		$result = $this->queryAll($sql, $class);
		return $result[0];
	}
	public function getAll($table){
		$sql = 'SELECT * FROM ' . $table;
		return $this->queryAll($sql);
	}
	
	public function getNotAll($sql){
		return $this->query($sql);
	}
	
	public function insert($sql)
	{
		return $this->execute($sql);		
	}
	*/
}
