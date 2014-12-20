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
		$users = $this->admin_model->getAllUsers(array());
		print_r($users);
		//$this->load->view('admin/users');
	}
	
	public function admins()
	{
		$isAdmin = $this->users_lib->isAdmin();
		if(empty($isAdmin)){
			redirect('home');
		}		
		$this->load->model('admin_model');
		$admins = $this->admin_model->getAllAdmins(array());
		print_r($admins);
		//$this->load->view('admin/users');
	}
	
	
}
