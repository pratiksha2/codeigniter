<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Shortlist extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->profiles();
	}
	
	public function profiles($id = NULL) {
		if(empty($id) || !is_numeric($id) || $id <= 0){
			$id = $this->users_lib->getUserId();
		}
		if(empty($id)){
			redirect('login');
		}
		
		$this->load->model('users_model');
		$myId = $this->users_lib->getUserId();
		$viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		
		$this->load->model('shortlist_model');
		$shortlistedProfiles = $this->shortlist_model->getShortlistedProfiles( array('id'=>$id) );
		$shortlistData['shortlistData'] = $shortlistedProfiles;
		$data['viewData'] = $shortlistData;
		$data['view']='shortlist';
		$data['document']['title']='Matrimony Site - My Shortlists ';
		$this->load->view('main', $data);
	}
	
	public function add($profileId,$id = NULL) {
		$profileId = (int)$profileId;
		$id = (int)$id;
		$returnArr =  array('result'=>FALSE);
		if(empty($id)){
			$id = 1; //getid from session
		}
		if(empty($profileId)){
			echo json_encode($returnArr);
			return;
		}
		
		$this->load->model('shortlist_model');
		$returnArr['result'] = $this->shortlist_model->add($profileId,$id);
		echo json_encode($returnArr);
		return;
	}
	
	public function remove($profileId,$id = NULL) {
		$profileId = (int)$profileId;
		$id = (int)$id;
		$returnArr =  array('result'=>FALSE);
		if(empty($id)){
			$id = 1; //getid from session
		}
		if(empty($profileId)){
			echo json_encode($returnArr);
			return;
		}
		
		$this->load->model('shortlist_model');
		$returnArr['result'] = $this->shortlist_model->remove($profileId,$id);
		echo json_encode($returnArr);
		return;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */