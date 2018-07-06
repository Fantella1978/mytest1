<?php

abstract class AbstractModel
	implements IModel
{
	protected static $table;
	
	# protected static $class;
	
	protected $data = Array();
	
	public function __set($k, $v)
	{
		$this->data[$k] = $v;
	}
	
	public function __get($k)
	{
		return $this->data[$k];
	}
		
	public static function getAll()
	{
		$db = new DB;
		$class = get_called_class();
		$db->setClassName($class);
		$sql = 'SELECT * FROM `' . static::$table; # . '` LIMIT 0,10';
		return $db->query($sql);
	}
	
	public static function findAll()
	{
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$sql = 'SELECT * FROM ' . static::$table;
		return $db->query($sql);
	}
	
	public static function findOneByPk($id)
	{
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
		return $db->query($sql, Array(':id' => $id));
	}

	public static function findByColumn($column, $value)
	{
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . ' = :value';		
		return $db->query($sql, Array(':value' => $value));
	}

	public function insert()
	{
		$db = new DB();
		$class = get_called_class();
		$db->setClassName($class);
		$cols = array_keys($this->data);
		$data = Array();
		foreach ($cols as $col){
			$data[':' . $col] = $this->data[$col];
		}
		$sql = 'INSERT INTO ' . static::$table . ' (' . implode(', ', $cols) . ') VALUES (' . implode(', ', array_keys($data)) . ')';
		
		#var_dump($this->data);
		#echo $sql;
		#die;
		$result = $db->execute($sql, $data);
		if ($result){
			$this->id = $db->lastInsetId();
		}
		return $result;
	}
	
	public function update()
	{
		$db = new DB();
		$cols = array_keys($this->data);
		$data = Array();
		$ArCols = Array();
		foreach ($cols as $col){
			$data[':' . $col] = $this->data[$col];
			$ArCols[] =  $col . ' = :' . $col;
		}
		$sql = 'UPDATE ' . static::$table . ' SET ' . implode(', ', $ArCols) . ' WHERE id = :id';
		return $db->query($sql, Array(':id' => $this->id));
	}

	public function delete()
	{
		$db = new DB();
		$sql = 'DELETE ' . static::$table . ' WHERE id=:id';
		return $db->query($sql, Array(':id' => $this->id));
	}

	public static function getOne($id)
	{
		$db = new DB;
		$sql = 'SELECT * FROM `' . static::$table . '` WHERE id=' . $id;
		return $db->queryOne($sql, static::$class);
	}

}
