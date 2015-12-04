<?php
class Controller
{
	public function __construct()
	{

		$this->load = new Loader();
		$this->load->script('php', 'tool/sql');
	}

}