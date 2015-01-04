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
		$isAdmin = $this->users_lib->isAdmin();
		if($isAdmin==TRUE && isset($id)){
			// allow admin to edit users profile
		}else{
			if(empty($id) || !is_numeric($id) || $id <= 0){
				$id = $this->users_lib->getUserId();
			}
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
		$isShortListed = NULL;
		if($myId != $id){
			$isShortListed = FALSE;
			$myShortlistIds = $this->profile_model->getShortListIds($myId);
			if(	in_array($id , $myShortlistIds) ){
				$isShortListed = TRUE;
			}
		}
		$viewData['isShortListed'] = $isShortListed;
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
	
	public function edit($id = NULL)
	{
		if($this->input->post()){
			$post = $this->input->post();
			if( $post['form'] == 'users' ){
				$this->editProfile($post);
			}else{
				$this->editProcess($post);
				return;
			}			
		}
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$this->load->model('utility_model');
		
		$isAdmin = $this->users_lib->isAdmin();
		if($isAdmin==TRUE && isset($id)){
			// allow admin to edit users profile
		}else{
			$id = $this->users_lib->getUserId();
			
			if(empty($id)){
				redirect('login');
			}
		}
		
		$viewData['ProfileData'] = $this->users_model->getUserBy('id',$id);
		$this->load->library('formhtml_lib');
		$viewData['profile'] = $this->profile_model->getUserProfileById($id);
		$viewData['profile']['PartnerSeekingInfo'] = $this->profile_model->getPartnerSeekingInfo($id);
		$myId = $this->users_lib->getUserId();
		$viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
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
			case 'ContactInfo' 			:	$whichInfo = 'contact_info';	break;
		    case 'EducationInfo'		:	$whichInfo = 'education_info';	break;
		    case 'FamilyInfo'			:	$whichInfo = 'family_info';		break;
		    case 'LocationInfo'			:	$whichInfo = 'location_info';	break;
		    case 'PersonalInfo'			:	$whichInfo = 'personal_info';	break;
		    case 'ReligionInfo'			:	$whichInfo = 'religion_info';	break;
			case 'PartnerSeekingInfo'	:	$whichInfo = 'partner_seeking';	break;
			default 					:	$whichInfo = NULL;				break;
		}
		unset($post['form']);
		$id = NULL;
		$isAdmin = $this->users_lib->isAdmin();
		if($isAdmin==TRUE && isset($post['userId'])){
			// allow admin to edit users profile
			$id = $post['userId'];
		}
		unset($post['userId']);
		$this->profile_model->setInfo( $post , $whichInfo , $id );
	}
	
	public function editProfile($post){
		unset($post['form']);
		$isUploaded = NULL;
	
		if($this->input->post('UsersSubmit')){
			$this->load->helper('string');
			$config['upload_path'] = './uploads/avatars/';
			$config['allowed_types'] = 'gif|jpeg|jpg|png';
			$config['max_size']	= '4096';
			$config['file_name'] = random_string('alnum', 8) . '_' . time();
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('profilePic')){
				$error = array('error' => $this->upload->display_errors());
				
				if($error['error']=='<p>You did not select a file to upload.</p>'){	//	do not show if user dint uploaded profile pic
					unset($error);
				}
			}else{
				$data=$this->upload->data();
				$isUploaded = $data['file_name'];
			}
		}
		
		$post['ProfilePic'] = $isUploaded;
		
		$id = NULL;
		$isAdmin = $this->users_lib->isAdmin();
		if($isAdmin==TRUE && isset($post['userId'])){
			// allow admin to edit users profile
			$id = $post['userId'];
		}
		unset($post['userId']);
		$this->load->model('profile_model');
		$this->profile_model->setBasicInfo( $post , $id );
		
	}
	
	function thumb($data){
		$config['image_library'] = 'gd2';
		$config['source_image'] =$data['full_path'];
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 275;
		$config['height'] = 250;
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */