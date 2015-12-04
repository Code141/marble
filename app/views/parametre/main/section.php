<section class="center" id="section_center">

	<div class="masque" id="profilpicmasque">
		<div class="change">
		Change your profil pic
		<img class="profilpicsmall" src="<?php echo MEDIA_PATH;?>user/<?php echo $_SESSION['user']['id'];?>/profilpic.jpg">
			<form class="changevalue">
				<input type="button" value="Upload"><br>
				<div class="button">
					<div class="cancel" onClick="document.getElementById('profilpicmasque').style.visibility = 'hidden'">
						Cancel
					</div>
					<div class="okay">
						Okay
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="masque" id="firstnamemasque">
		<div class="change">
			Change your firstname
			<form class="changevalue">
				<input value="<?php echo $_SESSION['user']['firstname'];?>" onClick="this.value='';" onBlur="if(this.value==''){this.value = '<?php echo $_SESSION['user']['firstname'];?>'}"><br>
				<div class="button">
					<div class="cancel" onClick="document.getElementById('firstnamemasque').style.visibility = 'hidden'">
						Cancel
					</div>
					<div class="okay">
						Okay
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="masque" id="lastnamemasque">
		<div class="change">
			Change your lastname
			<form class="changevalue">
				<input value="<?php echo $_SESSION['user']['lastname'];?>" onClick="this.value='';" onBlur="if(this.value==''){this.value = '<?php echo $_SESSION['user']['lastname'];?>'}"><br>
				<div class="button">
					<div class="cancel" onClick="document.getElementById('lastnamemasque').style.visibility = 'hidden'">
						Cancel
					</div>
					<div class="okay">
						Okay
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="masque" id="gendermasque">
		<div class="change">
			Change your gender
			<form class="changevalue">
				<input type="radio" class="changevalue" name="gender" value="0" id="male"<?php if($_SESSION['user']['gender']){echo' checked';}?>>
				<label for="male">
				</label>
				
				<input type="radio" class="changevalue" name="gender" value="1" id="female"<?php if(!$_SESSION['user']['gender']){echo' checked';}?>>
				<label for="female">
				</label>
				
				<div class="button">
					<div class="cancel" onClick="document.getElementById('gendermasque').style.visibility = 'hidden'">
						Cancel
					</div>
					<div class="okay">
						Okay
					</div>
				</div>
				
			</form>
		</div>
	</div>
	
	<div class="masque" id="mailmasque">
		<div class="change">
			Change your mail
			<form class="changevalue">
				<input value="<?php echo $_SESSION['user']['mail'];?>" onClick="this.value='';" onBlur="if(this.value==''){this.value = '<?php echo $_SESSION['user']['mail'];?>'}"><br>
				<div class="button">
					<div class="cancel" onClick="document.getElementById('mailmasque').style.visibility = 'hidden'">
						Cancel
					</div>
					<div class="okay">
						Okay
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="masque" id="birthdaymasque">
		<div class="change">
			Change your birthday
			<form class="changevalue">
				<input value="<?php echo $_SESSION['user']['birthday'];?>" onClick="this.value='';" onBlur="if(this.value==''){this.value = '<?php echo $_SESSION['user']['birthday'];?>'}"><br>
				<div class="button">
					<div class="cancel" onClick="document.getElementById('birthdaymasque').style.visibility = 'hidden'">
						Cancel
					</div>
					<div class="okay">
						Okay
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="contact">
		<img class="profilpicmedium" src="<?php echo MEDIA_PATH;?>user/<?php echo $_SESSION['user']['id'];?>/profilpic.jpg" onClick="document.getElementById('profilpicmasque').style.visibility = 'visible'">
		<p class="info">
			<a href="#" onClick="document.getElementById('firstnamemasque').style.visibility = 'visible'"><span id="firstname"><?php echo $_SESSION['user']['firstname'];?></span></a><a href="#" onClick="document.getElementById('lastnamemasque').style.visibility = 'visible'"><span id="lastname"><?php echo $_SESSION['user']['lastname'];?></span></a><a href="#" onClick="document.getElementById('gendermasque').style.visibility = 'visible'"><span class="gender" id="<?php echo gender($_SESSION['user']['gender']);?>"></span></a>
			<br>
			<a href="#" onClick="document.getElementById('mailmasque').style.visibility = 'visible'"><span><?php echo $_SESSION['user']['mail'];?></span></a>
			<br>
			<a href="#" onClick="document.getElementById('birthdaymasque').style.visibility = 'visible'"><span id="birthday"><?php echo $_SESSION['user']['birthday'];?></span></a>
		</p>
	</div>


	CHANGER MOT DE PASS<br>
	<br>

	/*----champs sql inexistant----*/<br>
	nationalitée/langue<br>
	Français<br>
	<br>
	pays<br>
	France<br>
	<br>
	ville<br>
	Paris<br>
	/*--------------------------------------*/


</section>


