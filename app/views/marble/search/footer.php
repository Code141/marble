

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
		<a href="index.php?location=message">
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

			<div class="search_path">
				
				<div class="search_path_element">
					SEARCH PATH :
				</div>
				
				<?php if(isset($_POST['search']))
				{
					echo '<div class="search_path_element">'.$_POST['search'].'</div>';
				}
				?>
				           
				
				<div class="search_path_element" id="ajax_path">
				</div>
			</div>
												<div class="bottom_pad"></div>

			<?php
		while ($data_array = $data['marble']['objwheresameadj']->fetch()){
			echo $data_array['id'].' - '.$data_array['name'].' - '.$data_array['id_adjectif'].'<br>';

		}
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
