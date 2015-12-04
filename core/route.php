<?php
//DEFINIR LES INFO DE BASE POUR DECOUPER L'URL/URI
$uri = $_SERVER['PATH_INFO'];
$uri = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $uri);

if(strpos($uri, '/') === 0){
	$uri = ltrim($uri, '/');
	$uri = rtrim($uri, '/');
}

$request = ($uri == '/') ? '' : $uri;
$request = explode('/', $request);

$controller = ($request[0] != '') ? $request[0] : $defaultController ;
$action = (isset($request[1])) ? $request[1] : $defaultAction ;
$params = (isset($request[2])) ? array_slice($request, 2) : NULL ;
