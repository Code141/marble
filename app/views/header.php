			<header>
				<div class="logo bar">
					<p>MARBLE</p>
					<span>Bêta</span>
				</div>
				

				<div class="research bar">
					<?php if(CONTROLLER != "parametre"){
						?>

						<img id="headerpic" src="<?php echo SITE_ROOT;?>app/assets/media/user/<?php echo $_SESSION['user']['id'];?>/profilpic.jpg">
						<p class="firstname">
							<?php echo $_SESSION['user']['firstname'];?>

							<span class="lastname"><br>
								<?php echo $_SESSION['user']['lastname'];?>

							</span>
						</p>
						
						<?php
					}?>
						<div class="searchbar">
							<form method="post" action="<?php echo SITE_ROOT.CONTROLLER;?>/search">
								<input class="search" name="search" value="<?php if(CONTROLLER=="marble"){echo'Search into marble';}else{echo'Find a '.CONTROLLER;}?>" onFocus="this.value='';" onKeyUp="if(this.value!=''){xhrObject('suggest', 'searchByMetaphone/'+this.value, true);}" onBlur="if(this.value==''){this.value='<?php if(CONTROLLER=="marble"){echo'Search into marble';}else{echo'Find a '.CONTROLLER;}?>';}">
							</form>
						</div>
					</div>
					<nav>



						<a href="<?php echo SITE_ROOT;?>marble">
							<div class="bar_button<?php if(CONTROLLER == "marble"){echo '_active';};?> marble">

							</div>
						</a>
						<a href="<?php echo SITE_ROOT;?>friends">
							<div class="bar_button<?php if(CONTROLLER == "friends"){echo '_active';};?> friends">

							</div>
						</a>
						<a href="<?php echo SITE_ROOT;?>message">
							<div class="bar_button<?php if(CONTROLLER == "message"){echo '_active';};?> message">

							</div>
						</a>
						<a href="<?php echo SITE_ROOT;?>parametre">
							<div class="bar_button<?php if(CONTROLLER == "parametre"){echo '_active';};?> parametre">

							</div>
						</a>
					</nav>
				</header>
