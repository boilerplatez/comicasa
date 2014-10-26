<?php

ini_set('display_errors', 'On');
ini_set ( 'error_reporting', E_ALL );
error_reporting(E_ALL);

require_once("../lib/rudrax/core/init.php");
RudraX::loadConfig("../project.properties");
RudraX::init();
