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
		if($this->input->is_ajax_request() && $this->input->post()){
			$post = $this->input->post();
			//print_r($post['form']);
			$this->editProcess($post);
			return;
		}
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$this->load->model('utility_model');
		
		$id = $this->users_lib->getUserId();
		
		if(empty($id)){
			redirect('login');
		}
		
		$this->load->library('formhtml_lib');
		
		$location['countries'] = $this->utility_model->getAllCountries();
		
		$viewData['locations'] = $location;
		$viewData['ProfileData'] = $viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$id);
		$viewData['profile'] = $this->profile_model->getUserProfileById($id);
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		
		
		
		$data['view']='profile/edit';
		$data['document']['title']='Matrimony Site - Edit Profile';
		$this->load->view('main', $data);
	}
	
	public function editProcess($post)
	{
		$whichInfo = NULL;
		$this->load->model('profile_model');
		switch($post['form']){
			case 'ContactInfo' 		:	$whichInfo = 'contact_info';	break;
		    case 'EducationInfo'	:	$whichInfo = 'education_info';	break;
		    case 'FamilyInfo'		:	$whichInfo = 'family_info';		break;
		    case 'LocationInfo'		:	$whichInfo = 'location_info';	break;
		    case 'PersonalInfo'		:	$whichInfo = 'personal_info';	break;
		    case 'ReligionInfo'		:	$whichInfo = 'religion_info';	break;
			default 				:	$whichInfo = NULL;				break;
		}
		unset($post['form']);
		$this->profile_model->setInfo( $post , $whichInfo );
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */