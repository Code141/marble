<?php
var_dump($_POST);
echo '<br>';
echo stripslashes($_POST['logmail']);
echo '<br>';

echo stripslashes($_POST['logpass']);
echo '<br>';

echo stripslashes($_POST['logpassbis']);
echo '<br>';

echo stripslashes($_POST['firstname']);
echo '<br>';

echo stripslashes($_POST['lastname']);
echo '<br>';

echo stripslashes($_POST['birthdate']);
echo '<br>';


if(!isset($_POST['gender'])){
	$_POST['gender'] = 'null';
}

echo stripslashes($_POST['gender']);












?>