<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('user_model');
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
   $this->load->view('footer_view',$data);
  //}
 }
 public function welcome()
 {
  $data['title']= 'Welcome';
  $this->load->view('header_view',$data);
  $this->load->view('welcome_view.php', $data);
  $this->load->view('footer_view',$data);
 }
 public function login()
 {
  $email=$this->input->post('email');
  $password=md5($this->input->post('pass'));

  $result=$this->user_model->login($email,$password);
  if($result) $this->welcome();
  else        $this->index();
 }
 public function thank()
 {
 $this->load->library('form_validation');
  // field name, error message, validation rules
  $this->form_validation->set_rules('fname', 'User First Name', 'trim|xss_clean');
  $this->form_validation->set_rules('lname', 'User Last Name', 'trim|xss_clean');
  $this->form_validation->set_rules('loginId', 'LoginId', 'is_unique[users.LoginID]');
  $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|is_unique[users.Email]');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
  $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');

  if($this->form_validation->run() == FALSE && $this->session->userdata('userID') !== false)
  {
   $this->load->view("registration_view.php");
   $this->load->view('footer_view');
  }
  else
  {
   $email = $this->input->post('email');
   $random_hash = substr(md5(uniqid(rand(), true)), 16, 16);
   $this->user_model->add_user($random_hash);
   $this->sendVerificationEmail($email,$random_hash);
   $data['title']= 'Thank';
  $this->load->view('login.php', $data);
  $this->load->view('footer_view',$data);
  }
  
 }
 public function registration()
 {
  $data['title']= 'Home';
  $this->load->view("registration_view.php", $data);
  $this->load->view('footer_view',$data);
 }
 public function logout()
 {
  $newdata = array(
  'user_id'   =>'',
  'user_name'  =>'',
  'user_email'     => '',
  'logged_in' => FALSE,
  );
  $this->session->unset_userdata($newdata );
  $this->session->sess_destroy();
  $this->index();
 }
 public function partnerSeeking() 
 {
	$data['title']= 'Partner Seeking';
	$data['religion'] = $this->user_model->getreligion();
	$data['language'] = $this->user_model->getlanguage();
	$data['education'] = $this->user_model->geteducation();
	$data['profession'] = $this->user_model->getprofession();
	$this->load->view("partner_seeking.php", $data);
 }
 public function partner()
 {
 $this->load->library('form_validation');
  // field name, error message, validation rules
  $this->form_validation->set_rules('ageto', 'User Age to', 'trim|xss_clean|integer');
  $this->form_validation->set_rules('agefrom', 'User Age From', 'trim|xss_clean|integer');
  if($this->form_validation->run() == FALSE)
  {
   $this->partnerSeeking();
  }
  else
  {
	$this->user_model->add_partnerSeeking();
	$data['title']= 'Partner';
	$this->load->view('home_view.php', $data);
	$this->load->view('footer_view',$data);
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
	$q = $this->db->query("select * from users where Reset_code='" . $resetCode . "'");
	if ($q->num_rows > 0) {
		$this->load->view('reset_view');
	}
	}
	else {
	 echo "noable to load view";
	}
}
function newPassword()
{
	if ($this->input->post('newpassword')) {
		$this->user_model->addNewPassword();
		$this->load->view('login.php');
	}
}	
	
function verify($verificationText=NULL){  
  $noRecords = $this->user_model->verifyEmailAddress($verificationText);  
  if ($noRecords > 0){
   $error = array( 'success' => "Email Verified Successfully!"); 
  }else{
   $error = array( 'error' => "Sorry Unable to Verify Your Email!"); 
  }
  $data['errormsg'] = $error; 
  $this->load->view('verify_view.php', $data);   
}


function sendVerificationEmail($email,$random_code){  
  $content = "Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n http://localhost/codeigniter/user/verify/".$random_code."\n"."\n\nThanks\nAdmin Team";
  $this->user_model->sendVerificatinEmail($email,$random_code,$content);
  $this->load->view('index.php', $data);   
}

}
?>