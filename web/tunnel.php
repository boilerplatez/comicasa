<?php

/*
 * RudraX Framework : https://github.com/lnt/rudrax
*/

require_once "project.php";

global $TunnelDB;
$TunnelDB = RudraX::getDB('TUNNEL');

RudraX::mapRequest('',function($t="index",$token,$do='handshake'){
	define("IDLE_TIME", 3); //3 seconds
	define("IDLE_WAIT", 10);
	global $controller;
	$controller = RudraX::getNotificationController();
	$controller->setToken($token);
	$controller->invokeHandler($do);
});

$TunnelDB->close();



