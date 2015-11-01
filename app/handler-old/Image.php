<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

include_once(RUDRA . "/core/handler/AbstractPageHandler.php");
include_once(MODEL_PATH . "/Picture.php");

class Image extends AbstractPageHandler {

	public function invokeHandler(Smarty $viewModel,Header $header,$pid,
			$imageAction="view",User $user) {
		$header->title('PayPic');
		$header->import('picbootstrap','mypage');
		$viewModel->assign("pname","@RTPic");
		global $RDb;
		$picture = new Picture($pid,$user->getToken());
		//$image = Picture::getPicInfoById($pid);
		Browser::log($picture,$user->getToken(),$picture->image->uid,$user->getToken()==$picture->image->uid);
		$hasBaught = false;
		$hasSaved = false;
		$canBuy = false;

		if($user->isValid()){
			if($picture->isMyPic()){
				Browser::log('isMyPic');
				$user->set('canAccess_'.$pid, $picture->image->file_path);
			} else {
				$imageAccess = Picture::getPicAccess($pid,$user->getToken());
				$hasFileAccessIndexed= !empty($imageAccess);
				if($hasFileAccessIndexed){
					$hasBaught = ($imageAccess->baught==1);
					$hasSaved =  ($imageAccess->saved==1);
				}
				$canBuy = ($user->getCoins()>=$picture->image->price);
				if(strcmp("buyImage",$imageAction)==0){
					if($picture->isPaid() && !$hasBaught && $canBuy){
						if($hasFileAccessIndexed){
							$RDb->update("update file_access set baught=1 where uid=%d AND pid=%d",$user->uid,$pid);
						} else {
							$RDb->update("INSERT INTO file_access (uid,pid,baught,saved) values(%d,%d,1,1)",$user->uid,$pid);
							$hasFileAccessIndexed = true;
						}
						$user->setCoins($user->get('coins') - $picture->image->price);
						$hasBaught = true;
					}
				} else if(strcmp("saveImage",$imageAction)==0){
					if($hasFileAccessIndexed){
						$RDb->update("update file_access set saved=1 where uid=%d AND pid=%d",$user->uid,$pid);
					} else {
						$RDb->update("INSERT INTO file_access (uid,pid,baught,saved) values(%d,%d,0,1)",$user->uid,$pid);
						$hasFileAccessIndexed = true;
					}
					$hasSaved = true;
				} else if(strcmp("unsaveImage",$imageAction)==0){
					if($hasFileAccessIndexed){
						$RDb->update("update file_access set saved=0 where uid=%d AND pid=%d",$user->uid,$pid);
					}
					$hasFileAccessIndexed = true;
					$hasSaved = false;
				} else if(strcmp("likeImage",$imageAction)==0){
					if($hasFileAccessIndexed){
						$like = ($imageAccess->liked==0) ? 1 : 0;
						$RDb->update("update file_access set liked=%d where uid=%d AND pid=%d",$like,$user->uid,$pid);
					} else {
						$RDb->update("INSERT INTO file_access (uid,pid,liked,baught,saved) values(%d,%d,1,0,0)",$user->uid,$pid);
					}
					$picture->image->likes = $picture->image->likes+($like*2)-1;
					$RDb->update("update files set likes=%d where id=%d",$$picture->image->likes,$pid);
					$hasFileAccessIndexed = true;
				}
				if(!$picture->isPaid() || $hasBaught){
					$user->set('canAccess_'.$pid, $picture->image->file_path);
				}
			}
		}

		$viewModel->assign("isMyPic",$picture->isMyPic());
		$viewModel->assign("canBuy",$canBuy);
		$viewModel->assign("hasBaught",$hasBaught);
		$viewModel->assign("isPaid",$picture->isPaid());
		$viewModel->assign("hasSaved",$hasSaved);
		$viewModel->assign("image",$picture->image);
		return "image";
	}

}
