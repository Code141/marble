<?php

class Message extends Controller
{
	public function main($params = NULL)
	{
		$data['title'] = 'Message';
		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('message/main/asideleft', $data);


		$this->load->view('message/main/section', $data);

		$data['message']['conversation'] = $this->load->model('message', 'showconversation');

		$this->load->view('message/main/asideright', $data);
		$this->load->view('message/main/footer', $data);
		$this->load->view('html_stop', $data);
	}

	public function newmessageto($params = NULL)
	{
		echo 'newmessageto'.$params['0'];

		$data['message']['wichuser'] = $params['0'];

		$data['title'] = 'Message';
		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('message/main/asideleft', $data);
		$this->load->view('message/main/section', $data);

		$data['message']['conversation'] = $this->load->model('message', 'showconversation');

		$this->load->view('message/main/asideright', $data);
		$this->load->view('message/main/footer', $data);
		$this->load->view('html_stop', $data);
	}

	public function send($params = NULL)
	{
		$data['message']['conversation'] = $params['0'];
		$this->load->model('message', 'send', $data);
		header('location:'.SITE_ROOT.'message/showconversation/'.$data['message']['conversation'].'');
	}

	public function showconversation($params = NULL)
	{
		$data['title'] = 'Message';
		$data['message']['conversation'] = $params['0'];

		$this->load->view('html_start', $data);
		
		
		$this->load->view('header', $data);
		$this->load->view('message/showconversation/asideleft', $data);
		$data['message']['message'] = $this->load->model('message', 'showmessage', $data);
		$this->load->view('message/showconversation/section', $data);
		$data['message']['conversation'] = $this->load->model('message', 'showconversation');
		$this->load->view('message/showconversation/asideright', $data);
		$this->load->view('message/showconversation/footer', $data);
		$this->load->view('html_stop', $data);
	}

	public function messagetouser($params = NULL)
	{
		$data['title'] = 'Message';
		$data['message']['wichuser'] = $params['0'];

		// RECHERCHE CONVERSATION PRIVE AVEC CET USER (doesconversationexist)
		$conversation = $this->load->model('message', 'doesconversationexist', $data);
			//->SI NON NEW MESSAGE
		if(!$conversation->fetch()){
			//NON <br> -> NEW CONTROLLER FOR NEW MESSAGE TO THIS USER :'. $params['0'];
			header('location:'.SITE_ROOT.'message/newmessageto/'.$data['message']['wichuser'].'');

		}else{
			echo'OUI<br>';
			var_dump($conversation->fetchAll());
			//->SI OUI GET CONVERSATION ID & REDIRECT TO SHOWCONVERSATION ID

		}

/*
		$this->load->view('html_start', $data);

		
		$this->load->view('header', $data);
		$this->load->view('message/showconversation/asideleft', $data);
		$data['message']['message'] = $this->load->model('message', 'showmessage', $data);
		$this->load->view('message/showconversation/section', $data);
		$data['message']['conversation'] = $this->load->model('message', 'showconversation');
		$this->load->view('message/showconversation/asideright', $data);
		$this->load->view('message/showconversation/footer', $data);
		$this->load->view('html_stop', $data);
		*/
	}

}