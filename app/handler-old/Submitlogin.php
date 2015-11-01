<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

include_once(RUDRA . "/core/handler/AbstractPageHandler.php");

class Submitlogin extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,User $user,$uname,$upass) {
		$header->title('PayPic');
		$header->import('jqgeeks/bootstrap_css','google_login');
		$viewModel->assign("pname","@RTPic");
		if($user->auth($uname,$upass)){
			include_once(HANDLER_PATH."/Images.php");
			return Images::showlatest($viewModel);
		} else {
			return "login";
		}
	}

}
