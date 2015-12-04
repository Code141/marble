<?php

class Login extends Controller
{

	public function main($params = NULL)
	{
		$data['title'] = 'Login';
		$this->load->view('html_start', $data);
		$this->load->view('login/main/login', $data);
		$this->load->view('html_stop', $data);
	}

	public function checklogin($params = NULL)
	{
		$data=$this->load->script('php', 'login/checkinfo', $_POST);
		$data['dblogin'] = $this->load->model('login', 'takeUserByMail', $data);
		$this->load->script('php', 'login/checklogin', $data);
	}

	public function error($params = NULL)
	{
		$data['title'] = 'Login';
		$data['error'] = $params;
		$this->load->view('html_start', $data);
		$this->load->view('login/main/login', $data);
		$this->load->view('html_stop', $data);
	}

	public function logout($params = NULL)
	{
		$this->load->script('php', 'login/logout');
	}

	public function signup($params = NULL)
	{
		$data['title'] = 'Sing Up';
		$data['mail'] = $params['0'];
		$this->load->view('html_start', $data);
		$this->load->view('login/signup/signup', $data);
		$this->load->view('html_stop', $data);
	}

	public function checksingup($params = NULL)
	{
		$data['logmail'] = $_POST['logmail'];
		$data['dblogin'] = $this->load->model('login', 'takeUserByMail', $data);
		$data['checksingup'] = $this->load->script('php', 'login/checksignup', $data);

		$this->load->model('login', 'signUp', $data);

		$data['title'] = 'Sing Up';
		$this->load->view('html_start', $data);
		$this->load->view('login/signup/success', $data);
		$this->load->view('html_stop', $data);
	}
}