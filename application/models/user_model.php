<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
 }
 function login($email,$password)
 {
  $this->db->where("email",$email);
  $this->db->where("password",$password);

  $query=$this->db->get("user");
  if($query->num_rows()>0)
  {
   foreach($query->result() as $rows)
   {
    //add all data to session
    $newdata = array(
      'user_id'  => $rows->id,
      'user_name'  => $rows->username,
      'user_email'    => $rows->email,
      'logged_in'  => TRUE,
    );
   }
   $this->session->set_userdata($newdata);
   return true;
  }
  return false;
 }
 public function add_user()
 {
  $data=array(
    'FirstName'=>$this->input->post('fname'),
	'Lastname'=>$this->input->post('lname'),
    'Email'=>$this->input->post('email'),
    'Password'=>md5($this->input->post('password')),
	'Blocked'=>$this->input->post(0),
	'Gender'=>$this->input->post('gender'),
	'Activated'=>$this->input->post(0),
	'UserType'=>$this->input->post(1),
  );
  $this->db->set('RegistrationDate', 'NOW()', FALSE);
  $this->db->insert('users',$data);
  $userid = $this->db->insert_id();
  $userProfile = array(
	'UserID'=>$userid,
	'LoginID'=>$this->input->post('loginId')
  );
   $dob = $this->input->post('dob');
  $this->db->set('DOB', $dob, FALSE);
  $this->db->insert('user_profile',$userProfile);
 }
 public function getreligion(){
	$this->db->from('religion');
	$this->db->order_by('ReligionID');
	$result = $this->db->get();
	$return = array();
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		  $return[$row['ReligionID']] = $row['Religion'];
		}
	}

	return $return;
}
 public function getlanguage(){
	$this->db->from('languages');
	$this->db->order_by('id');
	$result = $this->db->get();
	$return = array();
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		  $return[$row['id']] = $row['MotherTongue'];
		}
	}

	return $return;
}
public function geteducation(){
	$this->db->from('education');
	$this->db->order_by('id');
	$result = $this->db->get();
	$return = array();
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		  $return[$row['id']] = $row['education'];
		}
	}

	return $return;
}
public function getprofession(){
	$this->db->from('profession');
	$this->db->order_by('id');
	$result = $this->db->get();
	$return = array();
	if($result->num_rows() > 0) {
		foreach($result->result_array() as $row) {
		  $return[$row['id']] = $row['profession'];
		}
	}

	return $return;
}
public function add_partnerSeeking() {
	$data=array(
    'Age'=>$this->input->post('ageto'),
	//'UserID'=>,
	'Lastname'=>$this->input->post('agefrom'),
    'MaritalStatus'=>$this->input->post('maritalstatus'),
    'Manglik'=>md5($this->input->post('manglik')),
	'ReligionCaste'=>$this->input->post('religion'),
	'MotherTongue'=>$this->input->post('language'),
	'Education'=>$this->input->post('education'),
	'Profession'=>$this->input->post('profession'),
  );
  $this->db->insert('partner_seeking',$data);

}
}
?>