<?php
class Friends extends Controller
{


	public function main($params = NULL)
	{
		$data['research'] = $_POST['search'];
		$data['canvas']['view'] = 'friends';

		$data['title'] = 'Friends';
		$data['friends']['userfriends'] = $this->load->model('friends', 'getAllFriends', $data);
		$data['friends']['users'] = $this->load->model('friends', 'showallmember');
		$data['friends']['user']['activities'] = $this->load->model('friends', 'allactivities', $params);


		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('friends/main/asideleft', $data);
		$this->load->view('friends/main/section', $data);
		$this->load->view('friends/main/asideright', $data);
		$this->load->view('friends/main/footer', $data);
		$this->load->script('php', 'canvas/canvasloader', $data);
		$this->load->view('html_stop', $data);

	}

	public function showmember($params = NULL)
	{
		$data['whichuserid'] = $params['0'];
		$isafriend = $this->load->model('friends', 'isAFriend', $data);
		$count = $isafriend->rowCount();

		if($count==0){
			$data['friends']['isafriend']=0;
		}elseif($count==1){
			$whoaskfriend = $isafriend->fetch();
			$isafriend->closeCursor();
			if($whoaskfriend['id_user']==$_SESSION['user']['id']){
				$data['friends']['isafriend']=1;
			}else{
				$data['friends']['isafriend']=2;
			}
		}elseif($count ==2){
			$data['friends']['isafriend']=3;
		}

		$data['research'] = $_POST['search'];
		$data['params'] = $params;
		$data['title'] = 'Friends';
		$data['friends']['userfriends'] = $this->load->model('friends', 'getAllFriends', $data);
		$data['friends']['users'] = $this->load->model('friends', 'showallmember');
		$data['friends']['user']['identity'] = $this->load->model('friends', 'showmember', $params);
		$data['friends']['user']['activities'] = $this->load->model('friends', 'tree', $params);
		$data['canvas']['view'] = 'tree';

		$this->load->script('php', 'tree/makeatree');

		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('friends/showmember/asideleft', $data);
		$this->load->view('friends/showmember/section', $data);
		$this->load->view('friends/showmember/asideright', $data);
		$this->load->view('friends/showmember/footer', $data);
		$this->load->script('php', 'canvas/canvasloader', $data);
		$this->load->view('html_stop', $data);

	}

	public function tree($params = NULL)
	{
		$data['research'] = $_POST['search'];

		$data['params'] = $params;
		$data['title'] = 'Friends';
		$data['friends']['users'] = $this->load->model('friends', 'showallmember');
		$data['friends']['user']['identity'] = $this->load->model('friends', 'showmember', $params);
		$data['friends']['user']['activities'] = $this->load->model('friends', 'tree', $params);
		$data['canvas']['view'] = 'tree';

		$this->load->script('php', 'tree/makeatree');

		$this->load->view('html_start', $data);
		$this->load->view('header', $data);
		$this->load->view('friends/tree/asideleft', $data);
		$this->load->view('friends/tree/section', $data);
		$this->load->view('friends/tree/asideright', $data);
		$this->load->view('friends/tree/footer', $data);
		$this->load->script('php', 'canvas/canvasloader', $data);
		$this->load->view('html_stop', $data);

	}
}