<?php

class Parametre extends Controller
{
	public function main($params = NULL)
	{
		$data['title'] = 'Parametre';
		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('parametre/main/asideleft', $data);
		$this->load->view('parametre/main/section', $data);
		$this->load->view('parametre/main/asideright', $data);
		$this->load->view('parametre/main/footer', $data);
		$this->load->view('html_stop', $data);
	}

	public function help($params = NULL)
	{
		$data['title'] = 'Help';
		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('parametre/help/asideleft', $data);
		$this->load->view('parametre/help/section', $data);
		$this->load->view('parametre/help/asideright', $data);
		$this->load->view('parametre/help/footer', $data);
	$this->load->view('html_stop', $data);
	}

}