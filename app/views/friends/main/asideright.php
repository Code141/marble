<aside class="right">
	<div id="friendlist" class="asideliste" onmouseover="divlisttiers(this);" onmouseout="divlisttiersclear(this);">		
		<p class="title">My friends</p>
		<div class="nano">
			<div class="content">

				<?php

				while ($data_array = $data['friends']['userfriends']->fetch()){
					echo '
					<a href="'.SITE_ROOT.'friends/showmember/'.$data_array['id'].'">
					<div class="user">
					<img src="'.SITE_ROOT.'app/assets/media/user/'.$data_array['id'].'/profilpic.jpg">
					'.$data_array['firstname'].' '.$data_array['lastname'].'<br>

					</div>
					</a>
					';
					$friendList[$data_array['id']]['firstname'] = $data_array['firstname'];
					$friendList[$data_array['id']]['lastname'] = $data_array['lastname'];
				}
				$data['friends']['userfriends']->closeCursor();


				?>
				<script>
				friendList = <?php echo json_encode($friendList);?>;	
				</script>
			</div>
		</div>
	</div>
	<div id="alluserlist" class="asideliste" onmouseover="divlisttiers(this);" onmouseout="divlisttiersclear(this);">		

		<p class="title">All users</p>
		<div class="nano">
			<div class="content">
				<?php

				while ($data_array = $data['friends']['users']->fetch()){
					echo '
					<a href="'.SITE_ROOT.'friends/showmember/'.$data_array['id'].'">
					<div class="user">
					<img src="'.SITE_ROOT.'app/assets/media/user/'.$data_array['id'].'/profilpic.jpg">
					'.$data_array['firstname'].' '.$data_array['lastname'].'<br>

					</div>
					</a>

					';
				}
				$data['friends']['users']->closeCursor();
				?>
			</div>		
		</div>
	</div>
	<div id="grouplist" class="asideliste" onmouseover="divlisttiers(this);" onmouseout="divlisttiersclear(this);">		

		<p class="title">Groupes</p>
		<div class="nano">
			<div class="content">
				SUGGESTION<br>
				INFO DE GROUPE<br>
				INFO DE SURVOL
			</div>
		</div>

	</aside>
