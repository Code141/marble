<aside class="right message">
	<p class="title">
		Conversations
	</p>
<?php
$conv=null;
while ($data_array = $data['message']['conversation']->fetch()){
	if($conv!=$data_array['conversation'] && $conv!=null){
		echo'</div>
	</a>
		';
	}

	if($conv!=$data_array['conversation']){
		echo'<a href="'.SITE_ROOT.'message/showconversation/'.$data_array['conversation'].'">
		<div>
			<img src="'.SITE_ROOT.'app/assets/media/user/'.$data_array['id'].'/profilpic.jpg">
			'.$data_array['firstname'];
	}else{
		echo'
			 & '.$data_array['firstname'];
	}			

	$conv = $data_array['conversation'];

}
$data['message']['conversation']->closeCursor();
?>
		</div>
	</a>		
</aside>

