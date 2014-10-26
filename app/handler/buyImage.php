<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class buyImage extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,$f, $page,$pid) {
		$header->title('PayPic');
		$header->import('jqgeeks/bootstrap_css','mypage');
		$viewModel->assign("pname","@RTPic");
		global $RDb;
		$image = $RDb->fetch("select * from files where id=%d", $pid);
		
		
		
		$viewModel->assign("image",$image);
		return "image";
	}

}
