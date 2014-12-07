<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		$this->view(NULL);
	}
	
	public function view($id){
		if(empty($id) || !is_numeric($id) || $id <= 0){
			$id = $this->users_lib->getUserId();
		}
		if(empty($id)){
			redirect('home');
		}
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$viewData['ProfileData'] = $this->users_model->getUserBy('id',$id);
		if(empty($viewData['ProfileData'])){
			redirect('profile');
		}
		$viewData['profile'] = $this->profile_model->getUserProfileById($id);
		$myId = $this->users_lib->getUserId();
		$viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		$data['view']='profile/view';
		$data['document']['title']='Matrimony Site - Profile : ' . $viewData['ProfileData']->FirstName . ' ' . $viewData['ProfileData']->LastName;
		$this->load->view('main', $data);
	}
	
	public function create()
	{
		$viewData['ProfileData'] = 'Siddhesh Chavan';
		$myId = $this->users_lib->getUserId();
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		$data['view']='profile/create';
		$data['document']['title']='Matrimony Site - Create Profile';
		$this->load->view('main', $data);
	}
	
	public function edit()
	{
		$id = $this->users_lib->getUserId();
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$viewData['ProfileData'] = $this->users_model->getUserBy('id',$id);
		$viewData['myProfile'] = $this->profile_model->getUserProfileById($id);
		$myId = $this->users_lib->getUserId();
		$viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		$data['view']='profile/edit';
		$data['document']['title']='Matrimony Site - Edit Profile';
		$this->load->view('main', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */