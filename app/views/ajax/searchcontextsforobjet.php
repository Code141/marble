<p class="title">
	<?php echo $data['name'];?>	in the context of :
</p>
<div class="context">
	
	<?php
	while ($data_array = $data['marble']['adjectifs']->fetch()){
		if($data_array['id_user']==$_SESSION['user']['id']){
			$sliceOwned = 1;	
		}else{
			$sliceOwned = 0;	
		}

		?>
		<p 
		onclick="
		getElementById('ajaxtest').innerHTML = '';
		"
		onMouseOver="
		clearAllPathElement();
		addPathElement('<?php echo $data_array['name'];?>');
		addPathElement('<?php echo $data['name'];?>');
		xhrObject('ajaxslice', 'getSliceById/<?php echo $data_array['id'].'/'.$data_array['name'].'/'.$data['name'].'/'.$sliceOwned.'/';?>', false);
		objnew[0].destruct();
		objnew['<?php echo $data_array['id'];?>'] = new makeSlice('<?php echo $data_array['id'];?>', 0, 0, 0, 1, '<?php echo $data['name'];?>', 1);
		"
		onMouseOut="
		removePathElement('<?php echo $data_array['name'];?>');
		removePathElement('<?php echo $data['name'];?>');
		getElementById('ajaxslice').innerHTML = '';
		objnew = null;
		objnew = new Array();
		objnew[0] = new makeTree(0, 0, 1, '<?php echo $_SESSION['user']['firstname']?>', userTree, 1);
		"
		>

		<?php

		if($sliceOwned){
			if(isset($data_array['name'])){
				echo '
				<span class="ownedSlice" id="'.$data_array['id'].'">'.$data_array['name'].' (Owned)</span>
				';
			}else{
				echo'<span class="name ownedSlice">Unknow Context</span>';
			}
		}else{
			if(isset($data_array['name'])){
				echo '
				<span id="'.$data_array['id'].'">'.$data_array['name'].'</span>
				';
			}else{
				echo'<span class="name">Unknow Context</span>';
			}
		}





		echo'</p>';
	}
	$data['marble']['adjectifs']->closeCursor();
	?>

</div>
