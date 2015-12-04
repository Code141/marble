<?php
if(!isset($data['error']['0'])){
$data['error']['0'] = '';
}
?>


<script>
function checkEmpty(target, mess) {
	if(document.getElementById(target).value == ''){
		document.getElementById(target).value = mess;
		document.getElementById(target).className='login badinput';
		document.getElementById(target).setAttribute('type', 'text');
	}
}

function waitPressEnter() {
setInterval(function(){
				document.getElementById('log').style.display = 'block';
},1000);
}
</script>


<header class="login">
	<div class="header_bar">
		<div class="header_shadows">
			<div class="header_shadows_left"></div>
			<div class="header_shadows_right"></div>
		</div>
		<p>MARBLE</p>
		<span class="login">Bêta</span>
	</div>
</header>

<section class="login">
	<form method="post" action="<?php echo SITE_ROOT;?>login/checklogin">


<input class="login <?php
if($data['error']['0']=='invalidmail' OR $data['error']['0']=='unknowmail'){
	echo' badinput';
}
?>" type="text" name="logmail" id="logmail" onFocus="this.value='';this.className='login';" onBlur="checkEmpty(this.id, 'Email');"
<?php
if($data['error']['0']=='invalidmail' OR $data['error']['0']=='unknowmail'){
	echo'value="'.stripslashes($data['error']['1']).'" class="badinput"';
}elseif($data['error']['0']=='badpass'){
	echo'value="'.stripslashes($data['error']['1']).'"';
}else{
	echo'value="Email"';
}
?>
>

<input class="login<?php
if($data['error']['0']=='badpass'){
	echo' badinput';
}
?>" type="text" name="logpass" value="Password" id="Password" onFocus="this.value='';this.className='login';setAttribute('type', 'password');waitPressEnter();" onBlur="checkEmpty(this.id, 'Password');"
<?php
if($data['error']['0']=='invalidmail' OR $data['error']['0']=='unknowmail' OR $data['error']['0']=='badpass'){
	echo'class="badinput"';
}
?>
>

<p class="loginopt">
<input id="log" type="submit" value="Press Enter">
</p>

</form>

<?php
if($data['error']['0']=='invalidmail'){
	echo '<p class="badinput">Invalid Email</p>';
}elseif($data['error']['0']=='badpass'){
	echo '<p class="badinput">Invalid Password</p>';
}
elseif($data['error']['0']=='unknowmail'){
	echo '<p class="badinput">Unknow Account</p>
	<p class="loginopt">
	<a class="login" href="' . SITE_ROOT . 'login/signup/'.stripslashes($data['error']['1']).'">Sign Up !</a>
	</p>';
}

if($data['error']['0']=='badpass'){
	echo'
	<p class="loginopt">
	<a class="login">Forgotten your password ?</a>
	</p>
	';

	/*
href="' . SITE_ROOT . 'login/forgotpass/'.stripslashes($data['error']['1']).'"
	*/
}
?>
</section>






