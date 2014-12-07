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
  $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]');
  $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');

  if($this->form_validation->run() == FALSE)
  {
   $this->load->view("registration_view.php");
   $this->load->view('footer_view');
  }
  else
  {
   $this->user_model->add_user();
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
}
?>