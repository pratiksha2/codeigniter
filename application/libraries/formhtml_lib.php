<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formhtml_lib {

	public function getCountryList(){
		$CI =& get_instance();
		$CI->load->model('utility_model');
		$countries = $CI->utility_model->getAllCountries();
		$countryList = NULL;
		foreach($countries as $country){
			$countryList[$country->country_name] = $country->country_name;
		}
		return $countryList;
	}
	
	public function getStateList($country = ''){
		if(trim($country) == ''){
			return array();
		}
		$CI =& get_instance();
		$CI->load->model('utility_model');
		$states = $CI->utility_model->getStates($country);
		$stateList = NULL;
		foreach($states as $state){
			$stateList[$state->state] = $state->state;
		}
		return $stateList;
	}
	
	public function getCityList($state = ''){
		if(trim($state) == ''){
			return array();
		}
		$CI =& get_instance();
		$CI->load->model('utility_model');
		$cities = $CI->utility_model->getCities($state);
		$cityList = NULL;
		foreach($cities as $city){
			$cityList[$city->city] = $city->city;
		}
		return $cityList;
	}
	
	public function getLanguages()
    {
        $CI =& get_instance();
		$CI->load->model('utility_model');
		$languages = $CI->utility_model->getLanguages();
		$languageList = NULL;
		foreach($languages as $language){
			$languageList[$language->name] = $language->name;
		}
		return $languageList;
    }
    
    public function getNationalities()
    {
        $CI =& get_instance();
		$CI->load->model('utility_model');
		$nationalities = $CI->utility_model->getNationalities();
		$nationalityList = NULL;
		foreach($nationalities as $nationality){
			$nationalityList[$nationality->Nationality] = $nationality->Nationality;
		}
		return $nationalityList;
    }
	
    public function getFieldValues($field)
    {
        $CI =& get_instance();
		$CI->load->model('utility_model');
		$fieldValues = $CI->utility_model->getFieldValues($field);
		$fieldValueList = NULL;
		foreach($fieldValues as $fieldValue){
			$fieldValueList[$fieldValue->FieldValue] = $fieldValue->FieldValue;
		}
		return $fieldValueList;
    }
	
	public function getCountCountArray($count = 0)
    {
        $countList = NULL;
		for($i = 0; $i<=$count; ++$i){
			$countList[$i] = $i;
		}
		return $countList;
	}
}
