<?php
/*
 * To change this license header, choose License Headers in Project Properties. To change this template file, choose Tools | Templates and open the template in the editor.
*/

require_once "project.php";


global $RDb;
$RDb = RudraX::getDB('DB1');

// Default RudraX Plug
RudraX::mapRequest("home",function($q,$p,$f,$action="Login"){
	return RudraX::invokeHandler($action);
});

RudraX::mapRequest("image/{pid}",function($q,$p,$f,$pid){
	return RudraX::invokeHandler("Image");
});
RudraX::mapRequest("album/{aid}",function($q,$p,$f,$aid){
	return RudraX::invokeHandler("ViewAlbum");
});

RudraX::mapRequest("viewpic/{pid}",function($q,$p,$f,$pid){
	return RudraX::invokeHandler("ViewPic");
});
RudraX::mapRequest("static/pri/{uid}/{v}",function($q,$p,$f,$d,$uid,$v){
	//echo "nooo".$v;
	return RudraX::invokeHandler('Pic');
});

RudraX::mapRequest("uploader",function($q,$p,$f,$d){
	return RudraX::invokeHandler('Uploader');
});

RudraX::mapRequest("delete/{pid}",function($q,$p,$f,$pid){
	return RudraX::invokeHandler('DeleteImage');
});

RudraX::mapRequest("upload",function($q,$p,$f,$d){
	return RudraX::invokeHandler('Upload');
});

RudraX::mapRequest("admin/access",function($q,$p,$f,$pid){
	return RudraX::invokeHandler('ImageAccess');
});
// Define Custom Request Plugs
RudraX::mapRequest("template/{temp}",function($temp="nohandler"){
	return RudraX::invokeHandler($temp);
});

RudraX::mapRequest('data/{eventname}',function($eventName="dataHandler"){
	$controller = RudraX::getDataController();
	$controller->invokeHandler($eventName);
});

// Default Plug for default page
RudraX::mapRequest("",function($q,$p,$f,$d,$t="index"){
	return RudraX::invokeHandler("Images");
});


$RDb->close();
