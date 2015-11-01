<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
include_once(RUDRA . "/core/handler/AbstractTemplateHandler.php");

class ImageAccess extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,$f, $page) {
		$header->title('PayPic');
		$header->import('jqgeeks/bootstrap_css','mypage');
		$viewModel->assign("pname","@RTPic");
		
		global $RDb;
		$imageAccess = $RDb->fetchAll("select * from file_access fa,files f,user u".
				" where fa.pid=f.id and u.uid=fa.uid");
		
		$viewModel->assign("images",$imageAccess);
		return "imageAccess";
	}
}
