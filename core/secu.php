<?php
function secu($array){
	foreach ($array as &$value) {
		$value = strip_tags(preg_quote(mysql_real_escape_string($value)));
	}
	unset($value);
	return $array;
}






$_POST = secu($_POST);

if(!isset($_POST['search'])){
	$_POST['search']=NULL;
}

if(isset($params)){
	$params = secu($params);
}
