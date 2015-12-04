	<aside class="left">
		<?php

		while ($data_array = $data['friends']['user']['identity']->fetch()){
			?>
			<div class="user_identity">

				<img class="friend_profilpic" src="<?php echo MEDIA_PATH;?>user/<?php echo $data_array['id'];?>/profilpic.jpg">

				<p class="friend_name">

					<?php echo $data_array['firstname'];?>
					<br><span>
					<?php echo $data_array['lastname'];?>
				</span>


			</p>
			<a href="<?php echo SITE_ROOT;?>message/messagetouser/<?php echo $data_array['id'];?>">
				<div class="message"></div>
			</a>
			<?php




			if($data['friends']['isafriend']==0){


				?>
				<a onclick="xhrObject('messagebox', 'addFriend/<?php echo $data_array['id'];?>/<?php echo $data_array['firstname'];?>', false);">
					<div class="user_add"></div>
				</a>
				<?php
			}elseif($data['friends']['isafriend']==1){
				echo'YOU ASK AS FRIEND';
			}elseif($data['friends']['isafriend']==2){
				echo'HE WANNA BE YOUR FRIEND?';
				?>
				<a onclick="xhrObject('messagebox', 'acceptAsFriend/<?php echo $data_array['id'];?>/<?php echo $data_array['firstname'];?>', false);">
					YES
				</a>
				/
				<a onclick="xhrObject('messagebox', 'declineAsFriend/<?php echo $data_array['id'];?>/<?php echo $data_array['firstname'];?>', false);">
					NO
				</a>

				<?php
			}elseif($data['friends']['isafriend']==3){
				echo'FRIEND :)';
}
?>
</div>

<?php
}
$data['friends']['user']['identity']->closeCursor();
?>






<div class="last_activities  nano">
	<div class="content">
		<p class="title">User's Arborescance</p>
		<?php
		while ($data_array = $data['friends']['user']['activities']->fetch()){
			$bddBranches[$data_array['id']]['id'] = $data_array['id'];
			$bddBranches[$data_array['id']]['label'] = $data_array['name'];
			$bddBranches[$data_array['id']]['parent_id'] = $data_array['id_parent_slice'];

		}
		if(isset($bddBranches)){
			$userTree = createTree($bddBranches);
			?>

			<div id="list_tree">';
				<!-- BUILD JSON TREE -->
				<script>
				var userTree = <?php echo json_encode($userTree);?>;
				$(function() {
					$('#list_tree').tree({
						data: userTree,
					});
				});
				</script>
			</div>
			<?php
		}else{
			echo 'No arborescance found for this user';
		}
		?>

	</div>
</div>
</aside>