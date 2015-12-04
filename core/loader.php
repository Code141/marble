<?php
class Loader
{
	public function model($controller, $model, $params = NULL)
	{
		if($params)
		{
			extract($params);
		}
		require_once(APP_PATH.'models/'.$controller.'.php');
		$calledmodel = 'Db_'.$controller;
		$this->db = new $calledmodel();
		return($this->db->$model($params));
	}

	public function script($type, $file, array $data = NULL)
	{
		if($data)
		{
			extract($data);
		}
		require(APP_PATH.'script/'.$type.'/'.$file.'.'.$type);
		return ($data);
	}

	public function view($file, array $data = NULL)
	{
		if($data)
		{
			extract($data);
		}
		require(APP_PATH.'views/'.$file.'.php');
	}
}