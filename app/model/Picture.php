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
class Picture {

	public $pid;
	public $uid;
	public $image;

	public function  __construct($pid,$uid){
		$this->pid = $pid; $this->uid = $uid;
		global $RDb;
		$this->image = $RDb->fetch("SELECT 
				files.*, IFNULL( albums.name, 'Untitled' ) AS album_name FROM `files`
				LEFT JOIN albums ON albums.id = files.albumid
				LEFT JOIN (select * from file_access where file_access.uid=%d) as fa ON fa.pid = files.id
				where files.id=%d",$this->uid,$this->pid);
	}
	public function isPaid(){
		return ($this->image->price >0);
	}
	public function isMyPic(){
		return (($this->image->uid-0) == $this->uid);
	}
	public static function getPicById($pid){
		global $RDb;
		return $RDb->fetch("select * from files where id=%d", $pid);
	}

	public static function getPicInfoById($pid){
		global $RDb;
		return $RDb->fetch("SELECT *, files.id as id , IFNULL( albums.name, 'Untitled' ) AS album_name
				FROM `files` LEFT JOIN albums ON albums.id = files.albumid where files.id=%d", $pid);
	}

	public static function getPicAccess($pid,$uid){
		global $RDb;
		return $RDb->fetch("select * from file_access where pid=%d and uid=%d", $pid,$uid);
	}
}
