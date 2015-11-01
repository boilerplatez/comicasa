<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
/**
 * Description of User, it basically extends AbstractUser and implemetns atleast two methods
 *
 * @author Lalit Tanwar
*/
class User extends AbstractUser {

	public function getToken(){
		return $this->uid;
	}

	public function auth($username, $passowrd) {
		global $RDb;
		$res =  $RDb->fetchAll(
				"SELECT * FROM user WHERE uname = '%s' AND password = '%s'",
				$username,$passowrd);
		if(count($res)==0){
			//echo "no";
			$this->unauth();
			$this->set('coins',0);
			return false;
		} else {
			$this->uname = $username;
			$this->uid  = $res[0]->uid;
			$this->setValid();
			$this->set('coins',$res[0]->coins);
			Browser::log("coins",$this->get('coins'));
			//Browser::log("auth",$this->uid,$this->getData());
			return true;
		}
	}
	public function getCoins(){
		return $this->get('coins');
	}
	public function setCoins($count){
		global $RDb;
		$RDb->update("update user set coins=%d where uid=%d",$count,$this->uid);
		$this->set('coins',$count);
	}
	
	public function getProfile() {
		return array('fname' => 'John',
				'lname' => 'Smith',
				'email' => 'john.smith@example.com'
		);
	}

	public function unauth() {
		$this->setInValid();
	}

}
