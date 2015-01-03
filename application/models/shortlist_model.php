<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shortlist_model extends CI_Model {

	public function getShortlistedProfiles($params=NULL){
		$default = array(
            'page' => 1,
			'limit' => 20,
			'id' => NULL,
        );
        /* Merge with input options */
        $params = array_merge($default, $params);
		
		$this->load->database();
		
		$whereStr = "WHERE u.blocked = 0 AND u.activated = 1 AND s.IntrestedUserId = u.id AND s.UserID = " . $this->db->escape($params['id']) . " GROUP BY u.id" ;
		
		
		$sqlAll = "SELECT count(1) as counter FROM `users` u , `profile_shortlist` s " . $whereStr;
		$query = $this->db->query($sqlAll);
		$totalCount = $query->first_row()->counter;
		$returnData = NULL;
		if($totalCount>0){
		
			$currentPage = $params['page'];
			$limit = $params['limit'];
			
			$totalPages = ceil(($totalCount / $limit));
			
			$offset = ($currentPage-1) * $limit; 
			
			$sql = "SELECT u.id as userIdMain, u.FirstName, u.LastName, u.Gender, u.ProfilePic FROM `users` u , `profile_shortlist` s " . $whereStr . " LIMIT " . $offset . " , " . $limit;
			$query = $this->db->query($sql);
			$users = $query->result();
			$returnData = array(
									'users' 		=> $users,
									'totalPages' 	=> $totalPages,
									'currentPage' 	=> $currentPage,
									'params' 		=> $params,
								);
		}
		return $returnData;
	}
	
	public function add($profileId = NULL , $id = NULL){
		$sql = "SELECT count(1) as counter FROM `profile_shortlist` WHERE UserID = " . $this->db->escape($id) . " AND  IntrestedUserId = " . $this->db->escape($profileId) . "  LIMIT 1";
		$query = $this->db->query($sql);
		$isFound = $query->first_row()->counter;
		if(empty($isFound)){
			$sql = "INSERT INTO `profile_shortlist` (id, UserID, IntrestedUserId, AddDate) "
					. "VALUES ( NULL , " . $this->db->escape($id) . " , " . $this->db->escape($profileId) . " , now() )";
			$query = $this->db->query($sql);			
		}
		return TRUE;
	}
	
	public function remove($profileId = NULL , $id = NULL){
		$sql = "DELETE FROM `profile_shortlist` WHERE UserID = " . $this->db->escape($id) . " AND  IntrestedUserId = " . $this->db->escape($profileId) . "  LIMIT 1";
		$query = $this->db->query($sql);
		return TRUE;
	}
}
