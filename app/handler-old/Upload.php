<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
include_once(RUDRA_HANDLER . "/AbstractPageHandler.php");

class Upload extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,User $user, $page) {
		$header->title('PayPic');
		$viewModel->assign("pname","@RTPic");
		if($user->isValid()){
			$header->import('jqgeeks/bootstrap_css','upload');
			global $RDb;
			$images = $RDb->fetchAll("select * from files where uid=%d AND albumid=0", $user->getToken());
			$viewModel->assign("images",$images);
			return "upload";
		} else {
			$header->import('jqgeeks/bootstrap_css','google_login');
			return "login";
		}
	}

}
