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
		if($this->input->post()){
			$post = $this->input->post();
			$searchData = $this->doSearch($post);
		}
		$myId = $this->users_lib->getUserId();
		if(empty($myId)){
			redirect('login');
		}
		$viewData['searchData'] = $searchData;
		$this->load->model('users_model');
		$this->load->library('formhtml_lib');
		$navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		$data['view']='search_result';
		$data['document']['title']='Matrimony Site - Search Results';
		$this->load->view('main', $data);
	}
	
	public function doSearch($post){
		if(empty($this->input->post()) || empty($post)){
			redirect('search');
		}
		$this->load->model('search_model');
		
		$searchResult = $this->search_model->search($post);
		
		return $searchResult;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */