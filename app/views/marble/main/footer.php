

<footer>
	<nav>
		<a href="<?php echo SITE_ROOT;?>marble/main">
			<div class="bar_button arborescance">
				
			</div>
		</a>
		<a href="<?php echo SITE_ROOT;?>marble/search">
			<div class="bar_button search">
				
			</div>
		</a>
		<a href="<?php echo SITE_ROOT;?>marble/">
			<div class="bar_button">
				
			</div>
		</a>
		<a href="<?php echo SITE_ROOT;?>marble/path">
			<div class="bar_button path">
				
			</div>
		</a>
	</nav>
	<div class="research bar">
		<div class="dropzone bar">
			<div class="top_pad"></div>
				<div class="search_path_element">
					PATH :
				</div>
			<div id="search_path">
				

				
				<?php if(isset($_POST['search']))
				{
					echo '<div class="search_path_element">'.$_POST['search'].'</div>';
				}
				?>
				
			</div>
			<div class="bottom_pad">
			</div>
				<p class="title">All Objects</p>

		<?php
		if(isset($data['marble']['adjectifs'])){
			while ($data_array = $data['marble']['adjectifs']->fetch()){
				echo $data_array['id'].':'.$data_array['name'].'–';
			}
			$data['marble']['adjectifs']->closeCursor();}
			?>
			
			

		</div>
	</div>
	<nav>
		<a href="<?php echo SITE_ROOT;?>marble/">
			<div class="bar_button">

			</div>
		</a>
		<a href="<?php echo SITE_ROOT;?>marble/">
			<div class="bar_button">

			</div>
		</a>
		<a href="<?php echo SITE_ROOT;?>marble/">
			<div class="bar_button">

			</div>
		</a>
		<a href="<?php echo SITE_ROOT;?>marble/">
			<div class="bar_button">
				
			</div>
		</a>
	</nav>

</footer>
