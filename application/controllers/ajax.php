<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
		
	}
	
	public function getcities($state = NULL) {
		$this->load->model('utility_model');
		$cities = $this->utility_model->getCities($state);
		echo json_encode($cities);
	}
	
	public function getstates($country = NULL) {
		$this->load->model('utility_model');
		$states = $this->utility_model->getStates($country);
		echo json_encode($states);
	}

	public function getcountry($chars) {
		$this->load->model('utility_model');
		$countries = $this->utility_model->getCountries($chars);
		echo json_encode($countries);
	}
	
	public function remove_admin($UserID){
		$isAdmin = $this->users_lib->isAdmin();
		if($isAdmin!=TRUE){
			$return = array('err' => 'You are not authorised to perform this action.');
			echo json_encode($return);
			return;
		}		
		
		$this->load->model('admin_model');
		$isLastAdmin = $this->admin_model->isLastAdmin();
		if($isLastAdmin == TRUE){
			$return = array('err' => 'Only one Admin is left for your site.');
		}else{
			$isRemoved = $this->admin_model->remove_admin($UserID);
			if($isRemoved == TRUE){
				$return = array('success' => 'is removed from Admin List.');
			}else{
				$return = array('err' => 'unable to perform action.');
			}			
		}
		echo json_encode($return);
	}
	
	public function make_admin($UserID){
		$isAdmin = $this->users_lib->isAdmin();
		if($isAdmin!=TRUE){
			$return = array('err' => 'You are not authorised to perform this action.');
			echo json_encode($return);
			return;
		}
		
		$isUserAdmin = $this->users_lib->isAdmin($UserID);
		if($isUserAdmin==TRUE){
			$return = array('success' => 'is already promoted to admin.');
			echo json_encode($return);
			return;
		}
		
		$adminId = $this->users_lib->getUserId();
		$this->load->model('admin_model');
		$isAdded = $this->admin_model->make_admin( $UserID , $adminId );
		if($isAdded == TRUE){
			$return = array('success' => 'is added to site Admin List.');
		}else{
			$return = array('err' => 'unable to perform action.');
		}
		echo json_encode($return);
	}
	
	
    public function activate_user($id = NULL){
        if(empty($id)){
            return;
        }
        $isAdmin = $this->users_lib->isAdmin();
        if($isAdmin!=TRUE){
            $return = array('err' => 'You are not authorised to perform this action.');
            echo json_encode($return);
            return;
        }
        $this->load->model('admin_model');
        $activated = $this->admin_model->activateUser($id);
        if($activated==TRUE){
            $return = array('success' => TRUE);
        }else{
            $return = array('err' => 'Unable to perform action.');
        }
        echo json_encode($return);
        return;
    }
    
    public function deactivate_user($id = NULL){
        if(empty($id)){
            return;
        }
        $isAdmin = $this->users_lib->isAdmin();
        if($isAdmin!=TRUE){
            $return = array('err' => 'You are not authorised to perform this action.');
            echo json_encode($return);
            return;
        }
        $this->load->model('admin_model');
        $deActivated = $this->admin_model->deActivateUser($id);
        if($deActivated==TRUE){
            $return = array('success' => TRUE);
        }else{
            $return = array('err' => 'Unable to perform action.');
        }
        echo json_encode($return);
        return;
    }
    
    public function block_user($id = NULL){
        if(empty($id)){
            return;
        }
        $isAdmin = $this->users_lib->isAdmin();
        if($isAdmin!=TRUE){
            $return = array('err' => 'You are not authorised to perform this action.');
            echo json_encode($return);
            return;
        }
        $this->load->model('admin_model');
        $blocked = $this->admin_model->blockUser($id);
        if($blocked==TRUE){
            $return = array('success' => TRUE);
        }else{
            $return = array('err' => 'Unable to perform action.');
        }
        echo json_encode($return);
        return;
    }
    
    public function unblock_user($id = NULL){
        if(empty($id)){
            return;
        }
        $isAdmin = $this->users_lib->isAdmin();
        if($isAdmin!=TRUE){
            $return = array('err' => 'You are not authorised to perform this action.');
            echo json_encode($return);
            return;
        }
        $this->load->model('admin_model');
        $unblocked = $this->admin_model->unBlockUser($id);
        if($unblocked==TRUE){
            $return = array('success' => TRUE);
        }else{
            $return = array('err' => 'Unable to perform action.');
        }
        echo json_encode($return);
        return;
    }
    
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */