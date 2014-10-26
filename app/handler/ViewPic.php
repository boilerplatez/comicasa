<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

include_once(RUDRA . "/core/handler/AbstractTemplateHandler.php");
include_once(MODEL_PATH . "/Picture.php");

class ViewPic extends AbstractTemplateHandler {
	public static $freePics;

	public function  __construct(){
		if(self::$freePics ==NULL) self::$freePics = new RxCache('pics');
	}

	public function invokeHandler(User $user, $img, $page,$pid) {

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-store, no-cache,must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0",false);
		header("Pragma: no-cache");
		header("Content-type: image/jpeg");

		$hasAccess = false;
		$file_path = null;
		$isPaid = true;
		
		if($user->isValid()){
			$file_path = $user->get('canAccess_'.$pid);
			$hasAccess = ($file_path!=null);
		} else {
			$file_path = self::$freePics->get($pid);
			if($file_path==null){
				$image = Picture::getPicById($pid);
				$isPaid = ($image->price>0);
				$file_path = $image->file_path;
				if($isPaid) self::$freePics->set($pid,false);
				else  self::$freePics->set($pid,$file_path);
			} else if($file_path==false) {
				$isPaid = true;
			} else {
				$isPaid = false;
			}
		}

		if($hasAccess || !$isPaid){
			// If they're authorized, read userphotos/$PATH
			// The .htaccess file is in userphotos (since that's the top level we care to protect)
			// so the path is relative to that folder. auth.php is up one level to keep photos
			// and code as separate as possible
			//@readfile("../static/def.gif");
			@readfile("../static/pri/".$file_path); // Read and send image file
		}else{
			@readfile("../static/def.gif");
		}
	}

}
