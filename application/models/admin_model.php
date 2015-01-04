<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function isAdmin($id = NULL){
		if(empty($id)){
			$id = $this->users_lib->getUserId();
		}
		
		$this->load->database();		
		$sql = "SELECT count(1) as isAdmin FROM `admin` WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$isAdmin = $query->first_row()->isAdmin;
		if($isAdmin>0){
			return TRUE;
		}
		return FALSE;
	}
		
	public function getAllUsers($params=array()){
		$default = array(
            'blocked' => NULL,
            'activated' => NULL,
            'orderby' => 'desc',
            'searchby' => NULL,
            'search' => NULL,
			'page' => 1,
			'limit' => 20,
        );
        /* Merge with input options */
        $params = array_merge($default, $params);
		
		$this->load->database();
		
		$where = NULL;
		if( $params['blocked'] === 0 || $params['blocked'] === 1 ){
			$where[] = "( blocked = ". $this->db->escape($params['blocked']) ." )";
		}
		if( $params['activated'] === 0 || $params['activated'] === 1 ){
			$where[] = "( activated = ". $this->db->escape($params['activated']) ." )";
		}
		if( isset($params['searchby']) && isset($params['search']) ){
			$where[] = "( " . $this->db->escape_like_str($params['searchby']). " LIKE '%". $this->db->escape_like_str($params['search']) ."%' )";
		}
		$whereStr = '';
		if(isset($where)){
			$whereStr = "WHERE " . implode(' AND ' , $where);
		}
		
		$sqlAll = "SELECT count(1) as counter FROM `users` " . $whereStr;
		$query = $this->db->query($sqlAll);
		$totalCount = $query->first_row()->counter;
		
		$currentPage = $params['page'];
		$limit = $params['limit'];
		
		$totalPages = ceil(($totalCount / $limit));
		
		$offset = ($currentPage-1) * $limit; 
		
		$sql = "SELECT * FROM `users` " . $whereStr . "ORDER BY id " . $params['orderby'] . " LIMIT " . $offset . " , " . $limit;
		$query = $this->db->query($sql);
		$users = $query->result();
		$returnData = array(
								'users' => $users,
								'totalPages' => $totalPages,
								'currentPage' => $currentPage,
							);
		return $returnData;
	}
	
	public function getAllAdmins($params=array()){
		$default = array(
            'blocked' => NULL,
            'activated' => NULL,
            'orderby' => 'desc',
            'searchby' => NULL,
            'search' => NULL,
			'page' => 1,
			'limit' => 20,
        );
        /* Merge with input options */
        $params = array_merge($default, $params);
		
		$this->load->database();
		
		$where = NULL;
		$where[] = "( a.UserID = u.id )";
		if( $params['blocked'] === 0 || $params['blocked'] === 1 ){
			$where[] = "( u.blocked = ". $this->db->escape($params['blocked']) ." )";
		}
		if( $params['activated'] === 0 || $params['activated'] === 1 ){
			$where[] = "( u.activated = ". $this->db->escape($params['activated']) ." )";
		}
		if( isset($params['searchby']) && isset($params['search']) ){
			$where[] = "( u." . $this->db->escape_like_str($params['searchby']). " LIKE '%". $this->db->escape_like_str($params['search']) ."%' )";
		}
		$whereStr = '';
		if(isset($where)){
			$whereStr = "WHERE " . implode(' AND ' , $where);
		}
		
		$sqlAll = "SELECT count(1) as counter FROM `users` u , `admin` a " . $whereStr;
		$query = $this->db->query($sqlAll);
		$totalCount = $query->first_row()->counter;
		
		$currentPage = $params['page'];
		$limit = $params['limit'];
		
		$totalPages = ceil(($totalCount / $limit));
		
		$offset = ($currentPage-1) * $limit; 
		
		$sql = "SELECT * FROM `users` u , `admin` a " . $whereStr . " ORDER BY u.id " . $params['orderby'] . " LIMIT " . $offset . " , " . $limit;
		$query = $this->db->query($sql);
		$admins = $query->result();
		$returnData = array(
								'admins' => $admins,
								'totalPages' => $totalPages,
								'currentPage' => $currentPage,
							);
		return $returnData;
	}
	
	public function isLastAdmin(){
		$this->load->database();		
		$sql = "SELECT count(1) as isLastAdmin FROM `admin`";
		$query = $this->db->query($sql);
		$isLastAdmin = $query->first_row()->isLastAdmin;
		if($isLastAdmin<2){
			return TRUE;
		}
		return FALSE;
	}
	
	public function remove_admin($id = NULL){
		$id = (int)$id;
		if($id>0){
			$this->load->database();		
			$sql = "DELETE FROM `admin` WHERE UserID = " . $this->db->escape($id);
			$query = $this->db->query($sql);
			return TRUE;
		}
		return FALSE;
	}
	
	public function make_admin($id = NULL , $adminId = NULL){
		$id = (int)$id;
		$adminId = (int)$adminId;
		if( $id > 0 && $adminId > 0 ){
			$this->load->database();		
			$sql = "INSERT INTO `admin` (id, UserID, MadeAdminBy, AdminFrom) VALUES ( NULL , " . $this->db->escape($id) . " , " . $this->db->escape($adminId) . " , now())";
			$query = $this->db->query($sql);
			return TRUE;
		}
		return FALSE;
	}
	
	
    public function activateUser($id = NULL){
        if(empty($id)){
            return FALSE;
        }
        $this->load->database();
        $sql = "UPDATE `users` u SET Activated = 1 WHERE id = " . $this->db->escape($id) . " LIMIT 1";
        $query = $this->db->query($sql);
        return TRUE;
    }
    
    public function deActivateUser($id = NULL){
        if(empty($id)){
            return FALSE;
        }
        $this->load->database();
        echo $sql = "UPDATE `users` u SET Activated = 0 WHERE id = " . $this->db->escape($id) . " LIMIT 1";
        $query = $this->db->query($sql);
        return TRUE;
    }
    
    public function blockUser($id = NULL){
        if(empty($id)){
            return FALSE;
        }
        $this->load->database();
        $sql = "UPDATE `users` u SET Blocked = 1 WHERE id = " . $this->db->escape($id) . " LIMIT 1";
        $query = $this->db->query($sql);
        return TRUE;
    }
    
    public function unBlockUser($id = NULL){
        if(empty($id)){
            return FALSE;
        }
        $this->load->database();
        $sql = "UPDATE `users` u SET Blocked = 0 WHERE id = " . $this->db->escape($id) . " LIMIT 1";
        $query = $this->db->query($sql);
        return TRUE;
    }
    
	
}
