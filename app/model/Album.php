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
class Album {

	public $aid;
	public $images;
	public $album;

	public function  __construct($aid){
		$this->aid = $aid;
		global $RDb;
		$this->album = $RDb->fetch("select * from albums where id=%d",$aid);
		if(!$this->album){
			$this->album = array('id'=>0,'name'=>'Untitled','uid'=>-1);
		}
	}
	
	public function getImges(){
		global $RDb;
		if($this->images==null){
			$this->images = $RDb->fetchAll("select * from files where albumid=%d", $this->aid);
		}
		return $this->images;
	}

}
