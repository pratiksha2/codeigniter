<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	public function index()
	{
		$isAdmin = $this->users_lib->isAdmin();
		if(empty($isAdmin)){
			redirect('home');
		}
	}
	
	public function moderate($who = 'users')
	{
		$isAdmin = $this->users_lib->isAdmin();
		if(empty($isAdmin)){
			redirect('home');
		}		
		if($who=='admins'){
			$this->admins();
		}
		if($who=='users'){
			$this->users();
		}		
	}
	
	
	public function users()
	{
		$isAdmin = $this->users_lib->isAdmin();
		if(empty($isAdmin)){
			redirect('home');
		}		
		$this->load->model('admin_model');
		$this->load->model('users_model');
		$get = $this->input->get();
		if(empty($get)){
			$get = array();
		}
		$usersData = $this->admin_model->getAllUsers( $get );
		//print_r($usersData);
		
		$myId = $this->users_lib->getUserId();
		$viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$viewData['usersData'] = $usersData;
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		$data['view']='admin/users';
		$data['document']['title']='Matrimony Site - Admin Panel : All Site Users';
		$this->load->view('main', $data);
	}
	
	public function admins()
	{
		$isAdmin = $this->users_lib->isAdmin();
		if(empty($isAdmin)){
			redirect('home');
		}		
		$this->load->model('admin_model');
		$this->load->model('users_model');
		$get = $this->input->get();
		if(empty($get)){
			$get = array();
		}
		$adminsData = $this->admin_model->getAllAdmins( $get );
		//$this->load->view('admin/users');
		
		$myId = $this->users_lib->getUserId();
		$viewData['my'] = $navBarData['my'] = $this->users_model->getUserBy('id',$myId);
		$viewData['adminsData'] = $adminsData;
		$data['navBarData'] = $navBarData;
		$data['viewData'] = $viewData;
		$data['view']='admin/admins';
		$data['document']['title']='Matrimony Site - Admin Panel : All Site Users';
		$this->load->view('main', $data);
	}
	
	
}
