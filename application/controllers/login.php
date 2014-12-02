<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}
	
	public function verify(){
		$this->form_validation->set_rules('login', 'Email / Login ID', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		if($this->form_validation->run()){
			$this->load->model('users');
			$auth = $this->users->auth( $this->input->post('login') , $this->input->post('password') );
			if(	$auth['error'] ){
				
			}else{
				redirect('profile');
			}
		}else{
			$this->load->view('login');
		}
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */