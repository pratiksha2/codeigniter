<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function isAdmin($id = NULL){
		if(empty($id)){
			return FALSE;
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
		
	public function getAllUsers($params=NULL){
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
							);
		return $returnData;
	}
	
	public function getAllAdmins($params=NULL){
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
							);
		return $returnData;
	}
}
