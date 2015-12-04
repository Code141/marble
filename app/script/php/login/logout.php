<?php
$_SESSION = NULL; 
session_destroy();
header('location:'.SITE_ROOT);
