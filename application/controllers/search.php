<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
		$myId = $this->users_lib->getUserId();
		if(empty($myId)){
			redirect('login');
		}		
		$this->load->model('users_model');
		$this->load->library('formhtml_lib');
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['view']='search';
		$data['document']['title']='Matrimony Site - Search';
		$this->load->view('main', $data);
	}
	
	public function results()
	{
		$searchData = NULL;
		if($this->input->get()){
			$get = $this->input->get();
			$searchData = $this->doSearch($get);
		}
		$myId = $this->users_lib->getUserId();
		if(empty($myId)){
			redirect('login');
		}
		$viewData['searchData'] = $searchData;
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$this->load->library('formhtml_lib');
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$myShortlistIds = $this->profile_model->getShortListIds($myId);
		$viewData['myShortlistIds'] = $myShortlistIds;
		$data['viewData'] = $viewData;
		$data['view']='search_result';
		$data['document']['title']='Matrimony Site - Search Results';
		$this->load->view('main', $data);
	}
	
	public function suggestions()
	{
		$myId = $this->users_lib->getUserId();
		if(empty($myId)){
			redirect('login');
		}
		
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$this->load->library('formhtml_lib');
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$searchGender = 'Male';
		if(strtolower($navBarData['my']->Gender)=='male'){
			$searchGender = 'Female';
		}
		$get = $this->users_model->getSuggestionsParams($myId);
		$get['gender'] = $searchGender;
		$get['MaritalStatus'] = array($get['MaritalStatus']);
		$get['Manglik'] = array($get['Manglik']);
		$get['orderBy'] = ' RAND() ';
		$searchData = $this->doSearch($get);
		
		$viewData['searchData'] = $searchData;		
		$data['navBarData'] = $navBarData;
		$myShortlistIds = $this->profile_model->getShortListIds($myId);
		$viewData['myShortlistIds'] = $myShortlistIds;
		$data['viewData'] = $viewData;
		$data['view']='magic_search';
		$data['document']['title']='Matrimony Site - Suggestions';
		$this->load->view('main', $data);
	}
	
	public function doSearch($get){
		if(empty($get)){
			redirect('search');
		}
		$this->load->model('search_model');
		
		$searchResult = $this->search_model->search($get);
		
		return $searchResult;
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */