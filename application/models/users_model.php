<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	
	public function getUserBy($what = 'email',$value){
		if(empty($value) || !in_array($what , array('email','loginID','id'))){
			return NULL;
		}
		$this->load->database();
		if($what == 'id'){
			$sql = "SELECT * FROM users WHERE id = " . $this->db->escape($value) . " LIMIT 1";
		}elseif($what == 'email'){
			$sql = "SELECT * FROM users WHERE Email = " . $this->db->escape($value) . " LIMIT 1";
		}elseif($what == 'loginID'){
			$sql = "SELECT * FROM users WHERE LoginID = " . $this->db->escape($value) . " LIMIT 1";
		}
		$query = $this->db->query($sql);
		$user = $query->first_row();
		return $user;
	}
	
	public function getSuggestionsParams($id = NULL){
		if(empty($value)){
			$id = $this->users_lib->getUserId();
		}
		$this->load->database();
		$sql = "SELECT Age+1 as AgeTo,Age-1 as AgeFrom, MaritalStatus, Manglik, ReligionCaste, MotherTongue, Education, Profession FROM partner_seeking WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$partner_seeking = (array)$query->first_row();
		return $partner_seeking;
	}
	
	
}
