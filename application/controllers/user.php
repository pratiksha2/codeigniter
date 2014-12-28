<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('user_model');
   $this->load->library('form_validation');
 }
 public function index()
 {
  /*if(($this->session->userdata('user_name')!=""))
  {
   $this->welcome();
  }
  else{*/
   $data['title']= 'Home';
   $this->load->view('header_view',$data); 
   $this->load->view("home_view.php", $data);
   $this->load->view('footer',$data);
  //}
 }
 public function welcome()
 {
  $data['view']='welcome_view';
  $data['document']['title']='Matrimony Site - Welcome';
  $this->load->view('main', $data);
 }
 
 public function thank()
 {
 $this->load->library('form_validation');
  // field name, error message, validation rules
  $this->form_validation->set_rules('fname', 'User First Name', 'trim|xss_clean');
  $this->form_validation->set_rules('lname', 'User Last Name', 'trim|xss_clean');
  $this->form_validation->set_rules('loginId', 'LoginId', 'is_unique[users.LoginID]');
  $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|is_unique[users.Email]');
  $this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
  $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
  if($this->form_validation->run() == FALSE || $this->session->userdata('userID') !== false)
  {
   $this->load->view("registration_view.php");
  }
  else
  {
   $email = $this->input->post('email');
   $random_hash = substr(md5(uniqid(rand(), true)), 16, 16);
   $this->user_model->add_user($random_hash);
   $this->sendVerificationEmail($email,$random_hash);
   redirect('login');
  }
  
 }
 public function registration()
 {
  $data['title']= 'Home';
  $this->load->view("registration_view.php", $data);
 }

 public function partnerSeeking() 
 {
	$viewData['title']= 'Partner Seeking';
	$viewData['religion'] = $this->user_model->getreligion();
	$viewData['language'] = $this->user_model->getlanguage();
	$viewData['education'] = $this->user_model->geteducation();
	$viewData['profession'] = $this->user_model->getprofession();
	$myId = $this->users_lib->getUserId();
	$this->load->model('users_model');
	$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
	$data['navBarData'] = $navBarData;
	$data['viewData'] = $viewData;
	$data['view']='partner_seeking';
	$data['document']['title']='Matrimony Site - Partner';
	$this->load->view('main', $data);
 }
 public function partner()
 {
 $this->load->library('form_validation');
  // field name, error message, validation rules
  $this->form_validation->set_rules('ageto', 'User Age to', 'trim|xss_clean|integer');
  $this->form_validation->set_rules('agefrom', 'User Age From', 'trim|xss_clean|integer');
  $myId = $this->users_lib->getUserId();
  if(empty($myId)){
	redirect('login');
  }	
  elseif($this->form_validation->run() == FALSE)
  {
   $this->partnerSeeking();
  }
  else
  {
	$this->user_model->add_partnerSeeking();
	$myId = $this->users_lib->getUserId();
	$this->load->model('users_model');
	$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
	$data['navBarData'] = $navBarData;
	$data['view']='profile';
	$data['document']['title']='Matrimony Site - Partner';
	$this->load->view('main', $data);
  }
  
 }
 public function forget()
	{
		if (isset($_GET['info'])) {
               $data['info'] = $_GET['info'];
              }
		if (isset($_GET['error'])) {
              $data['error'] = $_GET['error'];
              }
		
		$this->load->view('login-forget');
	}
public function doforget()
	{
		$this->load->helper('url');
		$email= $_POST['email'];
		$q = $this->db->query("select * from users where Email='" . $email . "'");
        if ($q->num_rows > 0) {
            $r = $q->result();
            $user=$r[0];
			$random_hash = substr(md5(uniqid(rand(), true)), 16, 16);
			$this->user_model->resetPasswordCode($random_hash,$email); 
			//$this->resetpassword($user);
			$info= "Password reset link has been sent to email id: ". $email;
			//redirect('/index.php/login/forget?info=' . $info, 'refresh');
        }
		$error= "The email id you entered not found on our database ";
		//redirect('/index.php/login/forget?error=' . $error, 'refresh');
		
	}
public function reset(){
	$resetCode = $this->uri->segment(3);
	if(isset($resetCode) && $resetCode != '') {
	$q = $this->db->query("select * from users where ResetCode='" . $resetCode . "'");
	if ($q->num_rows > 0) {
		$myId = $this->users_lib->getUserId();
		$this->load->model('users_model');
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['view']='reset_view';
		$data['document']['title']='Matrimony Site - reset';
		$this->load->view('main', $data);  
	}
	}
	else {
	 echo "noable to load view";
	}
}
function newPassword()
{
	$this->form_validation->set_rules('newpassword', 'Password', 'required|matches[confirmpassword]');
	$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
	if ($this->form_validation->run() == FALSE) {
		$data['view']='reset_view';
		$data['document']['title']='Matrimony Site - reset_view';
	}
	else {
		$this->user_model->addNewPassword();
		$myId = $this->users_lib->getUserId();
		$this->load->model('users_model');
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['view']='login';
		$data['document']['title']='Matrimony Site - login';  
	}
	$this->load->view('main', $data);
}	
	
function verify($verificationText=NULL){  
  $noRecords = $this->user_model->verifyEmailAddress($verificationText);  
  if ($noRecords > 0){
   $error = array( 'success' => "Email Verified Successfully!"); 
  }else{
   $error = array( 'error' => "Sorry Unable to Verify Your Email!"); 
  }
  $data['errormsg'] = $error;
  $myId = $this->users_lib->getUserId();
  $this->load->model('users_model');
  $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
  $data['navBarData'] = $navBarData;
  $data['view']='verify_view';
  $data['document']['title']='Matrimony Site - verify';
  $this->load->view('main', $data);  
}


function sendVerificationEmail($email,$random_code){  
  $content = "Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://localhost/codeigniter/user/verify/".$random_code."\n"."\n\nThanks\nAdmin Team";
  $this->user_model->sendVerificatinEmail($email,$random_code,$content);
  $this->index();
}
function terms(){
	$myId = $this->users_lib->getUserId();
    $this->load->model('users_model');
    $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
    $data['navBarData'] = $navBarData;
	$data['view']='term_condition';
	$data['document']['title']='Matrimony Site - Terms';
	$this->load->view('main', $data);
}
function contactus(){
	$myId = $this->users_lib->getUserId();
    $this->load->model('users_model');
    $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
    $data['navBarData'] = $navBarData;
	$data['view']='contactus';
	$data['document']['title']='Matrimony Site - Contact Us';
	$this->load->view('main', $data);
}
function contact_thank() {
	$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
	$this->form_validation->set_rules('mob', 'Mobile number', 'trim|numeric|xss_clean');
	$myId = $this->users_lib->getUserId();
    $this->load->model('users_model');
    $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
    $data['navBarData'] = $navBarData;
	if($this->form_validation->run() == FALSE) {		
	  $data['view']='contactus';
	  $data['document']['title']='Matrimony Site - Contact Us';
    }
    else {
		$this->user_model->contactus();
		$data['view']='thank_you';
		$data['document']['title']='Matrimony Site - Thank You';
    }
	$this->load->view('main', $data);
}
}
?>