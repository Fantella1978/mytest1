<?php

class View
	implements IModel
{
	protected $data = Array();

	public function __set($k, $v)
	{
		$this->data[$k] = $v;
	}

	public function __get($k)
	{
		return $this->data[$k];
	}

	public function assign($name, $value)
	{
  		$this->data[$name] = $value;
	}
	
	public function display($template)
	{
		include __DIR__.'/../views/'.$template;
	}
}
