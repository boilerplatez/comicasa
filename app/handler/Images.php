<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
include_once(RUDRA . "/core/handler/AbstractPageHandler.php");

class Images extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,$f, $page) {
		$header->title('PayPic');
		$header->import('jqgeeks/bootstrap_css','mypage');
		$viewModel->assign("pname","@RTPic");
		return self::showLatest($viewModel);
	}

	public static function showLatest(Smarty $viewModel){
		global $RDb;
		$images = $RDb->fetchAll("select * from files order by id desc");
		$viewModel->assign("images",$images);
		return "images";
	}

}
