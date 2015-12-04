<aside class="right">
	<p class="title">EDIT SLICES</p>

	<?php
		echo '
		<div class="slice">
		<p class="slicetitle">'.$data['research'].' :<p/>';

	if(isset($data['marble']['adjectifs'])){
		while ($data_array = $data['marble']['adjectifs']->fetch()){
			echo '
			<span class="'.$data['research'].'Name name">'.$data_array['name'].'</span>
			<span class="'.$data['research'].'Score score">'.$data_array['score'].'</span>
			<hr>
			';
			

		}
		$data['marble']['adjectifs']->closeCursor();
	}
		?>
</div>
<p id="ajaxtest"></p>


	</aside>