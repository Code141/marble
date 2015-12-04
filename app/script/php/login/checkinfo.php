<?php
// To protect MySQL injection (more detail about MySQL injection)
$data['logmail'] = stripslashes($_POST['logmail']);
$data['encrypted_logpass']= hash('sha512', $_POST['logpass']);

$data['logmail'] = ($data['logmail'] != '') ? $data['logmail'] : 'Email' ;

if(!filter_var($data['logmail'], FILTER_VALIDATE_EMAIL)){
	session_destroy();
	header('location:'.SITE_ROOT.'login/error/invalidmail/'.$data['logmail']);
}

return ($data);



