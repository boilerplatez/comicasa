<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class Pic extends AbstractHandler {

	public function invokeHandler(User $user, $img, $page,$q) {
		$reqpath = strip_tags($q);
		// User albums are structured like so
		// ourURL.com/me/userphotos/<username>/<album>/...
		// $reqpath will now have the <username>/<album>/... part
		// <username> matches the username stored in the session variable
		// so we get a substring from the start of $reqpath to the first /

		//echo "no-".$q;  return;
		$foundslash = strpos($reqpath,'/');  // Get the position of the first slash

		if($foundslash === FALSE){  // $foundslash could return 0 or other "false" variables, use ===
			header("Location http://elementsbycaroline.com/index.php");
		}

		// Save their username off...
		$username = substr($reqpath,0,$foundslash);

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-store, no-cache,must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0",false);
		header("Pragma: no-cache");
		header("Content-type: image/jpeg");

		$hasAccess = false;
		if($user->isValid()){
			$hasAccess = true;
		}
		
		if($hasAccess){
			// If they're authorized, read userphotos/$PATH
			// The .htaccess file is in userphotos (since that's the top level we care to protect)
			// so the path is relative to that folder. auth.php is up one level to keep photos
			// and code as separate as possible
			//@readfile("../static/def.gif");
			@readfile("../".$reqpath); // Read and send image file
		}else{
			@readfile("../static/def.gif");
		}
	}

}
