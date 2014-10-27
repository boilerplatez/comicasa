<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
include_once(RUDRA . "/core/handler/AbstractPageHandler.php");
include_once(MODEL_PATH . "/Album.php");

class ViewAlbum extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,$f, $page,$aid) {
		$header->title('PayPic');
		$header->import('picbootstrap','mypage');
		$viewModel->assign("pname","@RTPic");
		$album = new Album($aid);
		$viewModel->assign("images",$album->getImges());
		return "images";
	}

}
