<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility_model extends CI_Model {

	public function getCountries($chars = ''){
		$this->load->database();		
		$sql = "SELECT * FROM `countries` WHERE Country LIKE ".$this->db->escape($chars."%")." LIMIT 10";
		$query = $this->db->query($sql);
		return $result = $query->result();		
	}
	
	public function getAllCountries(){
		$this->load->database();		
		$sql = "SELECT distinct(country_name) FROM `locations`  WHERE country_name !='' ORDER BY country_name;";
		$query = $this->db->query($sql);
		return $result = $query->result();		
	}
	
	public function getStates($country = NULL) {
		$this->load->database();
		$sql = "SELECT distinct(subdivision_name) as state FROM `locations` WHERE subdivision_name !='' ORDER BY subdivision_name;";
		if(isset($country)){
			$sql = "SELECT distinct(subdivision_name) as state FROM `locations` WHERE subdivision_name !='' AND country_name = " . $this->db->escape(urldecode ( $country )) . " ORDER BY subdivision_name;";
		}
		$query = $this->db->query($sql);
		return $result = $query->result();
	}

	public function getCities($state = NULL) {
		$this->load->database();
		$sql = "SELECT distinct(city_name) as city FROM `locations` WHERE city_name !='' ORDER BY city_name;";
		if(isset($state)){
			$sql = "SELECT distinct(city_name) as city FROM `locations` WHERE city_name !='' AND subdivision_name = " . $this->db->escape(urldecode ( $state )) . " ORDER BY city_name;";
		}
		$query = $this->db->query($sql);
		return $result = $query->result();
	}
	
	public function getLanguages(){
		$this->load->database();		
		$sql = "SELECT name FROM languages";
		$query = $this->db->query($sql);
		return $result = $query->result();		
	}
	
	public function getNationalities(){
		$this->load->database();		
		$sql = "SELECT Nationality FROM nationalities";
		$query = $this->db->query($sql);
		return $result = $query->result();		
	}
	
	public function getFieldValues($field){
		$this->load->database();		
		$sql = "SELECT FieldValue FROM profile_fields WHERE FieldName=" . $this->db->escape($field);
		$query = $this->db->query($sql);
		return $result = $query->result();		
	}
	
	
}
