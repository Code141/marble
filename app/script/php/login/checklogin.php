<?php


$data['dblogin'] = $data['dblogin']->fetchAll();
$count=0;
$count=count($data['dblogin']);


if($count!=1){
	session_destroy();
	header('location:'.SITE_ROOT.'login/error/unknowmail/'.$data['logmail']);
}

$data['dblogin'] = $data['dblogin']['0'];

if($count==1 && $data['dblogin']['pass']!=$data['encrypted_logpass']){
	session_destroy();
	header('location:'.SITE_ROOT.'login/error/badpass/'.$data['logmail']);
}

if($count==1 && $data['dblogin']['pass']==$data['encrypted_logpass']){
	$_SESSION['user']['id']=$data['dblogin']['id'];
	$_SESSION['user']['mail']=$data['dblogin']['mail'];
	$_SESSION['user']['firstname']=$data['dblogin']['firstname'];
	$_SESSION['user']['lastname']=$data['dblogin']['lastname'];
	$_SESSION['user']['birthday']=$data['dblogin']['birthday'];
	$_SESSION['user']['gender']=$data['dblogin']['gender'];
	$_SESSION['user']['account_date']=$data['dblogin']['account_date'];
	header('location:'.SITE_ROOT.'marble/');
}

