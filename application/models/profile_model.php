<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function getUserProfileById($id = NULL){
		if(empty($id)){
			$id = $this->users_lib->getUserId();
		}
		
		$userProfile['ContactInfo'] = $this->getContactInfo($id);
		$userProfile['EducationInfo'] = $this->getEducationInfo($id);
		$userProfile['FamilyInfo'] = $this->getFamilyInfo($id);
		$userProfile['LocationInfo'] = $this->getLocationInfo($id);
		$userProfile['PersonalInfo'] = $this->getPersonalInfo($id);
		$userProfile['ReligionInfo'] = $this->getReligionInfo($id);
		return $userProfile;
	}
	
	public function getContactInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM contact_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$ContactInfo = $query->first_row();
		return $ContactInfo;
	}
	public function getEducationInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM education_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$EducationInfo = $query->first_row();
		return $EducationInfo;
	}
	public function getFamilyInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM family_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$FamilyInfo = $query->first_row();
		return $FamilyInfo;
	}
	public function getLocationInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM location_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$LocationInfo = $query->first_row();
		return $LocationInfo;
	}
	public function getPersonalInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM personal_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$PersonalInfo = $query->first_row();
		return $PersonalInfo;
	}
	public function getReligionInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM religion_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$ReligionInfo = $query->first_row();
		return $ReligionInfo;
	}
		
		
	public function setInfo( $post , $whichInfo , $id = NULL ){
		$allowedTables = array('contact_info','education_info','family_info','location_info','personal_info','religion_info');
		if(!in_array($whichInfo,$allowedTables)){
			return;
		}
		
		$this->load->database();
		if(empty($id)){
			$id = $this->users_lib->getUserId();
		}
		$fields = $fieldsArr = NULL;
		foreach($post as $key => $val){
			$fieldsArr[] = $this->db->escape_str($key) . " = " . $this->db->escape($val);
		}
		if(empty($fieldsArr)){
			return;
		}
		$fields = implode(' , ' , $fieldsArr);
		$sql = "UPDATE " . $whichInfo . " SET " . $fields . " WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		
	}
		
}
