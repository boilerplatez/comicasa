<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

error_reporting(E_ALL | E_STRICT);
include_once (MODEL_PATH .'/ImageUploader.php');

class DeleteImage extends AbstractHandler {

	public function invokeHandler(User $user,$pid) {
		if($user->isValid()){
			global $RDb;
			$image = $RDb->fetch("select * from files where id=%d", $pid);

			$upload_handler = new ImageUploader(array(
					'user_token' => $user->getToken(),
			),false);
			$upload_handler->delete_file($image->id,$image->name);
		}
		header('Location: '.CONTEXT_PATH.'home');
	}

}
