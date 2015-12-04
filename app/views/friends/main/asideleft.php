	<aside class="left">
		<div class="last_activities  nano">
			<div class="content">
				<p class="title">Friends activities</p>
				<?php
				while ($data_array = $data['friends']['user']['activities']->fetch()){
					if(!isset($last_activities) OR $last_activities != $data_array['id_user']){
						echo'
						<img class="friend_profilpic_min" src="'.MEDIA_PATH.'user/'.$data_array['id_user'].'/profilpic.jpg">
						<a href="'.SITE_ROOT.'friends/showmember/'.$data_array['id_user'].'">
						'.$data_array['firstname'].'
						</a>
						';
					}
					echo'
					<p class="adjectif">
					<span class="date">'.$data_array['date'].'</span><br>
					'.$data_array['objet'].'
					<span class="argument">-IS-></span>
					'.$data_array['adjectif'].'
					<span class="argument">-AS-></span>
					<span class="note">'.$data_array['score'].'</span>
					</p>
					';
					$last_activities = $data_array['id_user'];
				}
				$data['friends']['user']['activities']->closeCursor();
				?>
			</div>
		</div>
	</aside>