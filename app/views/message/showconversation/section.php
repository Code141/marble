<section class="center" id="section_center">
	<section class="message nano">

<div class="content">
<?php
	if(isset($data['message']['message'])){
		while ($data_array = $data['message']['message']->fetch()){
			echo '
				<article class="message">
				<a href="'.SITE_ROOT.'friends/showmember/'.$data_array['id_user'].'">
				<img src="'.SITE_ROOT.'app/assets/media/user/'.$data_array['id_user'].'/profilpic.jpg">
				<p class="user">
				'.$data_array['firstname'].' :
				</p>
				</a>
				<p class="time">'.date($data_array['date']).'</p>
				<p class="text">'.$data_array['message'].'</p>
				</article>
			';
		}
		$data['message']['message']->closeCursor();
	}
?>
</div>
</div>
				
				<script>$(".nano").nanoScroller({ scroll: 'bottom' });</script>


</section>
			<section class="message_new">
					<form method="post" action="<?php echo SITE_ROOT;?>message/send/<?php echo $data['message']['conversation'];?>">
						<p class="message_new">New message :</p>
						<div class="submit">
							<input class="message_submit" type="submit" value="SEND">
						</div>
						<p class="message">
							<textarea name="message">Type your message here...</textarea>
						</p>
					</form>
				</section>

</section>


