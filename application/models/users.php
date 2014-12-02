<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

	public function getUser(){
		// get logged in user
		return $user;
	}
	
	public function getUserBy($what = 'email',$value){
		if(empty($value)){
			return NULL;
		}
		$this->load->database();
		if($what == 'email'){
			$sql = "SELECT * FROM users WHERE email = '" . $this->db->escape($value) . "' LIMIT 1";
		}elseif($what == 'loginID'){
			$sql = "SELECT * FROM users WHERE loginID = '" . $this->db->escape($value) . "' LIMIT 1";
		}else{
			$sql = "SELECT * FROM users WHERE id = '" . $this->db->escape($value) . "' LIMIT 1";
		}
		$query = $this->db->query($sql);
		$user = $query->result();
		return $user;
	}
	
	public function auth( $login , $password){
		$loginUsing = 'loginID';
		if(filter_var($login, FILTER_VALIDATE_EMAIL)){
			$loginUsing = 'email';
		}
		
		$user = getUserBy( $loginUsing , $login );
		if(empty($user)){
			return array('error' => 'Your ' . ucwords($loginUsing) . ' is not registered with us <a href="/user/register">Click here to Sign Up!</a>');
		}
		if($user->activated == 0){
			return array('error' => 'Your ' . ucwords($loginUsing) . ' is not activated, Kindly check your email for activation link');
		}
		if($user->blocked == 1){
			return array('error' => 'Your ' . ucwords($loginUsing) . ' is blocked by System Administrator');
		}
		if($user->password != md5($password)){
			return array('error' => 'Incorrect Email / Login ID and Password combination.');
		}else{
			//set session
			
		}
		
	}
}
