<script>
function checkMatch(mdpbis) {
	firstmdp = document.getElementById('logpass').value;
	if(firstmdp != mdpbis){
		document.getElementById('logpass').setAttribute('type', 'text');
		document.getElementById('logpassbis').setAttribute('type', 'text');
		document.getElementById('logpass').className='login badinput';
		document.getElementById('logpassbis').className='login badinput';
		document.getElementById('logpass').value = 'Passwords';
		document.getElementById('logpassbis').value = 'doesn\'t match';
	}else if(firstmdp == ''){
		document.getElementById('logpass').setAttribute('type', 'text');
		document.getElementById('logpassbis').setAttribute('type', 'text');
		document.getElementById('logpass').className='login badinput';
		document.getElementById('logpassbis').className='login badinput';
		document.getElementById('logpass').value = 'Please enter Password';
		document.getElementById('logpassbis').value = 'Retype Password';
	}else{
	//okay, yapluka verifier la difficultée du mdp
}
}

function checkEmpty(target, mess) {
	if(document.getElementById(target).value == ''){
		document.getElementById(target).value = mess;
		document.getElementById(target).className='login badinput';
	}
}

</script>



<header class="login">
	<div class="header_bar">
		<div class="header_shadows">
			<div class="header_shadows_left"></div>
			<div class="header_shadows_right"></div>
		</div>
		<p>SIGN UP</p>
		<span class="login">PRE-REGISTRATION</span>
	</div>
</header>


<section class="login">
	<form method="post" action="<?php echo SITE_ROOT;?>login/checksingup">
		<input class="login" type="email" name="logmail" id="logmail" value="<?php
		if(isset($data['mail'])){
			echo stripslashes($data['mail']);
		}else{
			echo 'Email';};?>" onFocus="this.value='';this.className='login'" onBlur="checkEmpty(this.id, 'Email');" required>
		<input class="login" type="text" name="logpass" id="logpass" value="Password" onFocus="this.value='';this.setAttribute('type', 'password');this.className='login';this.className='login'" onBlur="checkEmpty(this.id);" required>
		<input class="login" type="text" name="logpassbis" id="logpassbis" value="Retype Password" onFocus="this.value='';this.setAttribute('type', 'password');this.className='login'" onBlur="checkMatch(this.value);checkEmpty(this.id, 'Retype Password2');" required>
		<input class="login" type="text" name="firstname" id="firstname" value="Firstname" onFocus="this.value='';this.className='login'" onBlur="checkEmpty(this.id, 'Firstname');" required>
		<input class="login" type="text" name="lastname" id="lastname" value="Lastname" onFocus="this.value='';this.className='login';waitPressEnter();" onBlur="checkEmpty(this.id, 'Lastname');" required>
		<input class="login" type="date" name="birthdate" id="birthdate" value="Birthday" onFocus="this.value='';this.className='login'" onBlur="checkEmpty(this.id, 'Birthday');" required>
		<div class="gender">
			<input type="radio" class="login" name="gender" value="0" id="male">
			<label for="male">
				<span>
				</span>
			</label>
			<input type="radio" class="login" name="gender" value="1" id="female"/>
			<label for="female">
				<span>
				</span>
			</label>
		</div>

		<input id="registration" type="submit" value="Sign up">
	</form>
</section>
