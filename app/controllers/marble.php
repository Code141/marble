<?php

class marble extends Controller
{
	public function main($params = NULL)
	{
		$data['research'] = $_POST['search'];
		$data['title'] = 'Tree';
		$data['canvas']['view'] = 'tree';

		$data['marble']['mytree'] = $this->load->model('marble', 'mytree', $data);
		$data['marble']['adjectifs'] = $this->load->model('marble', 'alladjectifs', $data);


/*
TEST GET ALL SLICE FOR TREE
*/



$data['marble']['mytreetest'] = $this->load->model('marble', 'mytree', $data);

while ($data_array = $data['marble']['mytreetest']->fetch()){

	$bddTreeSlices[$data_array['id']]['id'] = $data_array['id'];
	$bddTreeSlices[$data_array['id']]['label'] = $data_array['name'];
	$bddTreeSlices[$data_array['id']]['parent_id'] = $data_array['id_parent_slice'];

	$data['research'] = $data_array['id'];
	$data['marble']['slices'] = $this->load->model('marble', 'getSliceById', $data);

	while ($data_array_slice = $data['marble']['slices']->fetch()){
		$bddTreeSlices[$data_array['id']]['slice'][$data_array_slice['id']]['id'] = $data_array_slice['id'];
		$bddTreeSlices[$data_array['id']]['slice'][$data_array_slice['id']]['name'] = $data_array_slice['name'];
		$bddTreeSlices[$data_array['id']]['slice'][$data_array_slice['id']]['score'] = $data_array_slice['score'];
	}
}

$data['marble']['mytreetest'] = $bddTreeSlices;




$this->load->script('php', 'tree/makeatree');

$this->load->view('html_start', $data);
$this->load->view('header', $data);
$this->load->view('marble/main/asideleft', $data);
$this->load->view('marble/main/section', $data);
$this->load->view('marble/main/asideright', $data);
$this->load->view('marble/main/footer', $data);
$this->load->script('php', 'canvas/canvasloader', $data);
$this->load->view('html_stop', $data);

}

public function search($params = NULL)
{
	if(isset($params['0'])){
		$data['research'] = $params['0'];
	}
	if(isset($_POST['add_adj'])){
		$data['research'] = $_POST['add_adj'];
		$data['marble']['id_obj'] = $this->load->model('marble', 'searchObjets', $data);
		while ($data_array = $data['marble']['id_obj']->fetch()){
			$data['id_add_adj'] = $data_array['id'];
		}
		$data['marble']['id_obj']->closeCursor();
		if(!isset($data['id_add_adj'])){
			$this->load->model('marble', 'addAdjObjet', $data);

			$data['marble']['id_obj'] = $this->load->model('marble', 'searchObjets', $data);
			while ($data_array = $data['marble']['id_obj']->fetch()){
				$data['id_add_adj'] = $data_array['id'];
			}
			$data['marble']['id_obj']->closeCursor();
		}

		$data['id_obj'] = $_POST['id_obj'];
		$this->load->model('marble', 'addAdjSlice', $data);
	}

	$data['research'] = $_POST['search'];

	$data['title'] = 'Search';
	$data['canvas']['view'] = 'search';

	$data['marble']['objets'] = $this->load->model('marble', 'searchObjets', $data);
	$data['marble']['adjectifs'] = $this->load->model('marble', 'searchAdjectifsByName', $data);
	$data['marble']['objwheresameadj'] = $this->load->model('marble', 'objwheresameadj', $data);

	$this->load->view('html_start', $data);
	$this->load->view('header', $data);
	$this->load->view('marble/search/asideleft', $data);
	$this->load->view('marble/search/section', $data);
	$this->load->view('marble/search/asideright', $data);
	$this->load->view('marble/search/footer', $data);
	$this->load->script('php', 'canvas/canvasloader', $data);
	$this->load->view('html_stop');
}

public function path($params = NULL)
{		
	$data['research'] = $_POST['search'];
	$data['title'] = 'Search';
	$data['canvas']['view'] = 'search';

	$data['marble']['objets'] = $this->load->model('marble', 'searchObjets', $data);
	$data['marble']['adjectifs'] = $this->load->model('marble', 'searchAdjectifsByName', $data);
	$data['marble']['objwheresameadj'] = $this->load->model('marble', 'objwheresameadj', $data);

	$this->load->view('html_start', $data);
	$this->load->view('header', $data);
	$this->load->view('marble/search/asideleft', $data);
	$this->load->view('marble/search/section', $data);
	$this->load->view('marble/search/asideright', $data);
	$this->load->view('marble/search/footer', $data);
	$this->load->view('html_stop');
}
}