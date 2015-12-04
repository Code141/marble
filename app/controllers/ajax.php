<?php
// SECURITEE !
// MUST ASK IF LOGGED BEFORE ANY RESPONSE
class ajax extends Controller{


	public function pullTree($params = NULL){	
		$data['idUser'] = $params[0]; 
		$data['marble']['mytree'] = $this->load->model('marble', 'getTree', $data);
		echo '<script>';
		while ($data_array = $data['marble']['mytree']->fetch()){
			echo 'dataPuller.getTree('.$data['idUser'].', '.$data_array['id'].','.$data_array['id_parent_slice'].','.$data_array['id_objet'].');';
		}
		$data['marble']['mytree']->closeCursor();

		echo '</script>';
	}

	public function pullSlice($params = NULL){	
		$data['research'] = $params[0]; 
		$data['marble']['slice'] = $this->load->model('marble', 'getSliceById', $data);
		echo '<script>';
		
		while ($data_array = $data['marble']['slice']->fetch()){
			echo 'dataPuller.getSlice('.$data['research'].','.$data_array['id'].','.$data_array['id_adjectif'].','.$data_array['score'].');';
		}
		
		$data['marble']['slice']->closeCursor();

		echo '</script>';
	}

	public function pullObjet($params = NULL){	
		$data['idObjet'] = $params[0]; 
		$data['marble']['objet'] = $this->load->model('marble', 'getObjetName', $data);
		
		echo '<script>';
		
		while ($data_array = $data['marble']['objet']->fetch()){
			echo 'dataPuller.getObjetName('.$data['idObjet'].',\''.$data_array['name'].'\');';
		}
		
		$data['marble']['objet']->closeCursor();

		echo '</script>';
	}








	public function searchByMetaphone($params = NULL){	
		$data['research'] = $params['0'];
		$data['marble']['adjectifs'] = $this->load->model('marble', 'searchByMetaphone', $data);

		if(isset($data['marble']['adjectifs'])){
			$this->load->view('ajax/searchbymetaphone', $data);
		}
	}


	public function searchContextsForObjet($params = NULL){		

		$data['research'] = $params['0'];
		$data['name'] = $params['1'];
		$data['marble']['adjectifs'] = $this->load->model('marble', 'searchSliceByObjetId', $data);

		$this->load->view('ajax/searchcontextsforobjet', $data);

	}


	public function getSliceById($params = NULL)
	{		
		$data['research'] = $params['0'];//idslice
		$data['ctxslice'] = $params['1'];
		$data['name'] = $params['2'];
		$data['sliceOwned'] = $params['3'];
		$data['marble']['adjectifs'] = $this->load->model('marble', 'getSliceById', $data);

		if(isset($data['marble']['adjectifs'])){
			$this->load->view('ajax/slice', $data);
		}
	}


	public function addAdjSlice($params = NULL)
	{
		$data['slice'] = $params[0]; 
		$data['research'] = $params[1];
		//ASK IF ADJ EXIST AND GET HIS ID
		$data['marble']['id_obj'] = $this->load->model('marble', 'searchObjets', $data);
		while ($data_array = $data['marble']['id_obj']->fetch()){
			$data['id_add_adj'] = $data_array['id'];	
		}
		$data['marble']['id_obj']->closeCursor();

		//IF IT DON'T CREAT IT AND GET HER ID	
		if(!isset($data['id_add_adj'])){
			$this->load->model('marble', 'addAdjObjet', $data);	
			$data['marble']['id_obj'] = $this->load->model('marble', 'searchObjets', $data);
			while ($data_array = $data['marble']['id_obj']->fetch()){
				$data['id_add_adj'] = $data_array['id'];
			}
			$data['marble']['id_obj']->closeCursor();
		}
		//FINALLY ADD TO SLICE THIS ADJ ID
		$this->load->model('marble', 'addAdjSlice', $data);
	}


	public function destroyAdjSlice($params = NULL)
	{
		$data['destroyadjslice'] = $params[0]; 
		$this->load->model('marble', 'destroyAdjSlice', $data);
	}



	public function moveTreeNode($params = NULL){	
		$data['slicetomove'] = $params['0'];
		$data['moveto'] = $params['1'];

		$this->load->model('marble', 'updateParentSlice', $data);
	}

	public function refreshtree($params = NULL){	

		$data['research'] = $params['0'];
		$data['marble']['objet_id'] = $this->load->model('marble', 'searchByMetaphone', $data);
		$data['marble']['mytree'] = $this->load->model('marble', 'mytree', $data);

		$this->load->script('php', 'tree/makeatree');

		while ($data_array = $data['marble']['mytree']->fetch()){
			$bddBranches[$data_array['id']]['id'] = $data_array['id'];
			$bddBranches[$data_array['id']]['label'] = $data_array['name'];
			$bddBranches[$data_array['id']]['parent_id'] = $data_array['id_parent_slice'];
		}
		$data['marble']['mytree']->closeCursor();

		$userTree = createTree($bddBranches);
		echo'
		<script>

		userTree = '.json_encode($userTree).';
		objnew[0].jsonTree = userTree;

		$( "#list_tree" ).unbind();
		$(function() {
			$(\'#list_tree\').tree({
				data: userTree,
				dragAndDrop: true,
			});
});


</script>
';
}

public function addSlice($params = NULL){	
	$data['research'] = $params['0'];

	$data['marble']['objet_id'] = $this->load->model('marble', 'searchObjets', $data);
	while ($data_array = $data['marble']['objet_id']->fetch()){
		$data['objetid'] = $data_array['id'];
	}
	$data['marble']['objet_id']->closeCursor();

	if (!isset($data['objetid'])) {
		$this->load->model('marble', 'addAdjObjet', $data);
		$data['marble']['objet_id'] = $this->load->model('marble', 'searchObjets', $data);
		while ($data_array = $data['marble']['objet_id']->fetch()){
			$data['objetid'] = $data_array['id'];
		}
		$data['marble']['objet_id']->closeCursor();
	}

	$this->load->model('marble', 'addSlice', $data);
}

public function removeSlice($params = NULL){	
	$data['research'] = $params['0'];

	$data['marble']['objet_id'] = $this->load->model('marble', 'searchObjets', $data);
	while ($data_array = $data['marble']['objet_id']->fetch()){
		$data['objetid'] = $data_array['id'];
	}
	$data['marble']['objet_id']->closeCursor();

	if (!isset($data['objetid'])) {
		$this->load->model('marble', 'addAdjObjet', $data);
		$data['marble']['objet_id'] = $this->load->model('marble', 'searchObjets', $data);
		while ($data_array = $data['marble']['objet_id']->fetch()){
			$data['objetid'] = $data_array['id'];
		}
		$data['marble']['objet_id']->closeCursor();
	}

	$this->load->model('marble', 'addSlice', $data);
}



public function addFriend($params = NULL){	
	$data['whichuserid'] = $params['0'];
	$data['whichusername'] = $params['1'];
		// TODO VERIFIE AVANT D'AJOUTER
	
	$isafriend = $this->load->model('friends', 'isAFriend', $data);

	$count = $isafriend->rowCount();
	
	if($count==0){
		$this->load->model('friends', 'addFriend', $data);
		echo 'An invitation has been sent to '.$data['whichusername'];
	}elseif ($count==1){
		echo 'You already asked '.$data['whichusername'].' to be your friend';
	}elseif($count ==2){
		echo 'COPAIIIING';
	}

	
	?>
	
	<script>
	fadeOut('messageboxmasque', 1500, 50);
	</script>
	<?php

}

public function acceptAsFriend($params = NULL){	
	$data['whichuserid'] = $params['0'];
	$data['whichusername'] = $params['1'];
		// TODO VERIFIE AVANT D'AJOUTER
	
	
	$this->load->model('friends', 'addFriend', $data);
	echo'HALLELUYA !!';

	
	?>
	
	<script>
	fadeOut('messageboxmasque', 1500, 50);
	</script>
	<?php

}

public function declineAsFriend($params = NULL){	
	$data['whichuserid'] = $params['0'];
	$data['whichusername'] = $params['1'];
		// TODO VERIFIE AVANT D'AJOUTER
	
	
	echo'NON-STOP';

	
	?>
	
	<script>
	fadeOut('messageboxmasque', 1500, 50);
	</script>
	<?php

}

}