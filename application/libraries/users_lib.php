<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_lib {

	public function getUserId(){
		// get logged in user
		$CI =& get_instance();
		$UserID = $CI->session->userdata('UserID');
		return $UserID;
	}
	
	public function auth( $login , $password){
		$loginUsing = 'loginID';
		if(filter_var($login, FILTER_VALIDATE_EMAIL)){
			$loginUsing = 'email';
		}
		$CI =& get_instance();
		$CI->load->model('Users_model');
		$user = $CI->Users_model->getUserBy( $loginUsing , $login );
		if(empty($user)){
			return array('error' => 'Your ' . ucwords($loginUsing) . ' is not registered with us <a href="/user/register">Click here to Sign Up!</a>');
		}
		if($user->Activated == 0){
			return array('error' => 'Your ' . ucwords($loginUsing) . ' is not activated, Kindly check your email for activation link');
		}
		if($user->Blocked == 1){
			return array('error' => 'Your ' . ucwords($loginUsing) . ' is blocked by System Administrator');
		}
		if($user->Password != md5($password)){
			return array('error' => 'Incorrect Email / Login ID and Password combination.');
		}else{
			//set session
			 $newdata = array(
						   'UserID'  => $user->id
						);
			$CI->session->set_userdata($newdata);
			redirect('profile');
		}
		
	}
	
	public function isAdmin(){
		// get logged in user
		$CI =& get_instance();
		$UserID = $this->getUserId();
		$UserID = 1;
		$CI->load->model('admin_model');
		$isAdmin = $CI->admin_model->isAdmin($UserID);
		return $isAdmin;
	}
	public function is_unique($str, $field) {
        $field_ar = explode('.', $field);
        $query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
        if ($query->num_rows() === 0) {
            return TRUE;
        }

        return FALSE;
    }
}
