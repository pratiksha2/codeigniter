<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {

	public function getCleanedParams( $params ){
	
		$search = array_filter($params);	// blank or empty element eliminated
		
		foreach($search as $key=>$tmp){
			if( $tmp == 'Will Tell You Later' ){
				unset($search[$key]);
			}
		}
		
		$default = array(
            'gender' 	=> NULL,
            'ageFrom' 	=> NULL,
            'ageTo' 	=> NULL,
            'MaritalStatus' 	=> NULL,
            'Manglik' 	=> NULL,
            'ReligionCaste' 	=> NULL,
            'MotherTongue' 	=> NULL,
            'LivingIn' 	=> NULL,
            'Education' => NULL,
            'page' 	=> 1,
            'limit' => 1,
        );
        /* Merge with input options */
        $search = array_merge($default, $search);
		
		
		
		return $search;
		
	}
	
	public function search( $params ){
		
		$params = $this->getCleanedParams( $params );
		
		$currentPage = $params['page'];
		$limit = $params['limit'];
		
		$sqls = $this->searchQueryBuilder( $params );
		$this->load->database();		
		$sql = $sqls['sqlAll'];
		$query = $this->db->query($sql);
		$totalCount = $query->first_row()->counter;
		$searchResults = NULL;
		if($totalCount>0){
			$totalPages = round(($totalCount / $limit));
			$offset = ($currentPage-1) * $limit;
			
			if(isset($params['orderBy'])){
				$sql = $sqls['sql']." ORDER BY ".$params['orderBy']." LIMIT ".$offset." , ".$limit;
			}else{
				$sql = $sqls['sql']." LIMIT ".$offset." , ".$limit;
			}
			$query = $this->db->query($sql);
			$search = $query->result();
			$searchResults = array(
										'totalPages' => $totalPages,
										'currentPage' => $currentPage,
										'search' => $search,
										'params' => $params,
									);
		}
		return $searchResults;
		
	}
	
	public function searchQueryBuilder( $searchParams ){
		if(empty($searchParams)){
			return NULL;
		}
		$searchParams = $this->getCleanedParams( $searchParams );
		
		$andArr = $orArr = $tbls = $cols = NULL;
        
		$this->load->database();
		
		$tbls['u'] = 'users u';
		$cols[] = 'u.id as userIdMain, u.Email, u.FirstName, u.LastName, u.Gender, u.ProfilePic';
		$andArr[] = "( u.Activated = '1' AND u.Blocked = '0' )";
		
		
        if(in_array(strtolower($searchParams['gender']),array('male','female'))){
            $andArr[] = '( u.Gender = '.$this->db->escape($searchParams['gender']).' )';
        }
        if(isset($searchParams['ageFrom'])){
            $searchParams['ageFrom'] = (int)$searchParams['ageFrom'];
        }else{
            $searchParams['ageFrom'] = 0;
        }
        if(isset($searchParams['ageTo'])){
            $searchParams['ageTo'] = (int)$searchParams['ageTo'];
        }else{
            $searchParams['ageTo'] = 0;
        }
        
        if($searchParams['ageFrom'] > $searchParams['ageTo']){
			$searchParams['ageFrom'] = $this->reverse_birthday($searchParams['ageFrom']);
            $searchParams['ageTo'] = $this->reverse_birthday($searchParams['ageTo']);
            $tbls['per'] = 'personal_info per';
			$cols[] = 'per.DOB';
            $andArr[] = '( per.DOB BETWEEN '.$this->db->escape($searchParams['ageFrom']).' AND  '.$this->db->escape($searchParams['ageTo']).' )';
        }
        if($searchParams['ageFrom'] < $searchParams['ageTo']){
			$searchParams['ageFrom'] = $this->reverse_birthday($searchParams['ageFrom']);
            $searchParams['ageTo'] = $this->reverse_birthday($searchParams['ageTo']);
            $tbls['per'] = 'personal_info per';
            $cols[] = 'per.DOB';
            $andArr[] = '( per.DOB BETWEEN '.$this->db->escape($searchParams['ageTo']).' AND  '.$this->db->escape($searchParams['ageFrom']).' )';
        }
        if(isset($searchParams['MaritalStatus'])){
			$searchParams['MaritalStatus'] = $this->getEscapedArray($searchParams['MaritalStatus']);
			$MaritalStatus = implode(",",$searchParams['MaritalStatus']);
            $tbls['per'] = 'personal_info per';
            $cols[] = 'per.MaritalStatus';
            $andArr[] = "( per.MaritalStatus IN (".$MaritalStatus.") )";
        }
        if(isset($searchParams['Manglik'])){
			$searchParams['Manglik'] = $this->getEscapedArray($searchParams['Manglik']);
			$Manglik= implode(",",$searchParams['Manglik']);
            $tbls['rel'] = 'religion_info rel';
            $cols[] = 'rel.Manglik';
            $andArr[] = "( rel.Manglik IN (".$Manglik.") )";
        }
        if(isset($searchParams['ReligionCaste'])){
            $tbls['rel'] = 'religion_info rel';
            $cols[] = 'rel.ReligionCaste';
            $andArr[] = "( rel.ReligionCaste LIKE '%".$this->db->escape_like_str($searchParams['ReligionCaste'])."%' )";
        }
        if(isset($searchParams['MotherTongue'])){
            $tbls['rel'] = 'religion_info rel';
            $cols[] = 'rel.MotherTongue';
            $andArr[] = "( rel.MotherTongue LIKE '%".$this->db->escape_like_str($searchParams['MotherTongue'])."%' )";
        }
        if(isset($searchParams['LivingIn'])){
            $tbls['loc'] = 'location_info loc';
            $cols[] = 'loc.LivingIn';
            $andArr[] = "( loc.LivingIn LIKE '%".$this->db->escape_like_str($searchParams['LivingIn'])."%' )";
        }
        if(isset($searchParams['Education'])){
            $tbls['edu'] = 'education_info edu';
            $cols[] = 'edu.Education';
            $andArr[] = "( edu.Education LIKE '%".$this->db->escape_like_str($searchParams['Education'])."%' )";
        }
        $joinStr = '';
        $oldKey = NULL;
		foreach($tbls as $key => $tbl){
            if(empty($oldKey)){
                $joinStr .= $tbl . ' ';
            }else{
				if($oldKey=='u'){
					$joinStr .= ' join ' . $tbl . ' on ' . $oldKey . '.id = ' . $key . '.UserID ';
				}else{
					$joinStr .= ' join ' . $tbl . ' on ' . $oldKey . '.UserID = ' . $key . '.UserID ';
				}
            }
            $oldKey = $key;
        }
        
		if(in_array('personal_info per',$tbls)){
			$cols[] = 'per.AboutMe';
		}
        
        //echo $joinStr;
		if(empty($orArr)){
			$orArr[] = 1;
		}
		if(empty($andArr)){
			$andArr[] = 1;
		}
        $orStr = implode(' OR ',$orArr);
        $andStr = implode(' AND ',$andArr);
		$colsStr = implode(' , ',$cols);
		
        $sqlAll = "SELECT count(1) as counter FROM ".$joinStr." WHERE ".$andStr." AND ".$orStr;
        $sql = "SELECT ".$colsStr." FROM ".$joinStr." WHERE ".$andStr." AND ".$orStr;
        
		$searchQuery = array(
								'sqlAll' => $sqlAll,
								'sql' => $sql
							);
		
		return $searchQuery;
	}
	
	function reverse_birthday($age=18) {
		$ageInTime = $age * 365 * 24 * 60 * 60;
		$time = time();
		$dt = date('Y-m-d',($time-$ageInTime));
		return $dt;
	}
	function getEscapedArray($arr=array()) {
		if(!is_array($arr)){
			$arr  = $this->db->escape($arr);
			return $arr;
		}
		if(count($arr)>0){
			foreach ($arr as $key=>$val){
				$arr[$key] = $this->db->escape($val);
			}
		}
		return $arr;
	}
	
	public function getContactInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM contact_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$ContactInfo = $query->first_row();
		return $ContactInfo;
	}
	public function getEducationInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM education_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$EducationInfo = $query->first_row();
		return $EducationInfo;
	}
	public function getFamilyInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM family_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$FamilyInfo = $query->first_row();
		return $FamilyInfo;
	}
	public function getLocationInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM location_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$LocationInfo = $query->first_row();
		return $LocationInfo;
	}
	public function getPersonalInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM personal_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$PersonalInfo = $query->first_row();
		return $PersonalInfo;
	}
	public function getReligionInfo($id){
		$this->load->database();		
		$sql = "SELECT * FROM religion_info WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		$ReligionInfo = $query->first_row();
		return $ReligionInfo;
	}
		
		
	public function setInfo( $post , $whichInfo , $id = NULL ){
		$allowedTables = array('contact_info','education_info','family_info','location_info','personal_info','religion_info');
		if(!in_array($whichInfo,$allowedTables)){
			return;
		}
		
		$this->load->database();
		if(empty($id)){
			$id = $this->users_lib->getUserId();
		}
		$fields = $fieldsArr = NULL;
		foreach($post as $key => $val){
			$fieldsArr[] = $this->db->escape_str($key) . " = " . $this->db->escape($val);
		}
		if(empty($fieldsArr)){
			return;
		}
		$fields = implode(' , ' , $fieldsArr);
		$sql = "UPDATE " . $whichInfo . " SET " . $fields . " WHERE UserID = " . $this->db->escape($id) . " LIMIT 1";
		$query = $this->db->query($sql);
		
	}
		
}
