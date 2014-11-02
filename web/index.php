<?php

ini_set('display_errors', 'On');
ini_set ( 'error_reporting', E_ALL );
error_reporting(E_ALL);

require_once("../lib/rudrax/core/init.php");
//Loads all the Constants
RudraX::loadConfig("../app/config/project.properties");
//Initialze Rudrax
RudraX::init();

global $RDb;
$RDb = RudraX::getDB('DB1');

// Define Custom Request Plugs
require_once(APP_PATH."/controller/web.php");

// Default RudraX Plug
RudraX::mapRequest("template/{temp}",function($temp="nohandler"){
	return RudraX::invokeHandler($temp);
});
RudraX::mapRequest('data/{eventname}',function($eventName="dataHandler"){
	$controller = RudraX::getDataController();
	$controller->invokeHandler($eventName);
});
// Default Plug for default page
RudraX::mapRequest("",function(){
	return RudraX::invokeHandler("Index");
});
$RDb->close();
