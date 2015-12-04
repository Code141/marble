<?php
function fix_keys($array) {
	foreach ($array as $k => $val) {
		if (is_array($val)){
            $array[$k] = fix_keys($val); //recurse
        }
        if(is_numeric($k)){
        	$numberCheck = true;
        }else{
        	$numberCheck = false;
        }
    }
    if($numberCheck === true){
    	return array_values($array);
    } else {
    	return $array;
    }
}

function getChildren(&$branches, $this_branch_tree){
	foreach ($this_branch_tree as $key => $value){
		foreach ($branches as $slice_id => $slice){
			if($slice['parent_id']==$value['id']){
				$this_branch_tree[$key]['children'][$slice_id]=$slice;
				unset($branches[$slice_id]);
				$this_branch_tree[$key]['children'] = getChildren($branches, $this_branch_tree[$key]['children']);
			}

		}
	}
	return $this_branch_tree;
}

function createTree($branches){

	$tree = array();
	foreach ($branches as $slice_id => $slice){
		if($slice['parent_id']=="0"){
			$tree[$slice_id] = $slice;
			unset($branches[$slice_id]);
		}
	}
	$tree = fix_keys(getChildren($branches, $tree));
	

	echo'<hr>';
	var_dump($branches);
	echo'<hr>';

	return $tree;
}