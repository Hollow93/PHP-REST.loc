<?php
/**
 * Class moodle_REST
 * This is the base class for accessing the moodle webservices
 */
class moodle_REST{
    private $config;
    function construct($config=array()){
        if(!$config){
            $defaults=array(
                'server_uri'=>variable_get('moodle_services_url',''),
                'access_token' => variable_get('moodle_services_auth_token',''),
                'service'=>variable_get('moodle_services_service',''),
            );
            $this->config=$config + $defaults;
        }
        // if if this isn't configured yet, don't do anything
        return ($this->config['access_token']?true:false);
    }
    function request($function, $addedparams=null){
        $url="{$this->config['server_uri']}/webservice/rest/server.php?moodlewsrestformat=json&wstoken={$this->config['access_token']}&wsfunction={$function}";
        if($addedparams){
            $url.="&{$addedparams}";
        }
        $return=drupal_http_request($url);
        return json_decode($return->data);
    }
}
class moodle_cohorts extends moodle_REST{
    function moodle_cohorts(){
        parent::construct();
    }
    function listing(){
        $this->request('core_cohort_get_cohorts');
    }
    function create($idnumber, $title, $description){
        $cohorts[0]['categorytype']['type']= 'system';
        $cohorts[0]['categorytype']['value']= $idnumber;
        $cohorts[0]['name']= $title;
        $cohorts[0]['idnumber']= $idnumber;
        $cohorts[0]['description']= $description;
        $cohorts[0]['descriptionformat']= 1;
        $cohorts[0]['visible']= 1;
        return $this->request('core_cohort_create_cohorts', drupal_http_build_query(array('cohorts'=>$cohorts)) );
    }
    function update(){
        // this probably doesn't work
        $this->request('core_cohort_create_cohorts');
    }
    function enrol($cohort_idnumber, $user_idnumber){
        $members[0]['cohorttype']['type']= 'idnumber' ;
        $members[0]['cohorttype']['value']= $cohort_idnumber;
        $members[0]['usertype']['type']= 'idnumber';
        $members[0]['usertype']['value']= $user_idnumber;
        $request= $this->request('core_cohort_add_cohort_members', drupal_http_build_query(array('members'=>$members)) );
        return $request;
    }
    function unenrol($cohort_idnumber, $user_idnumber){
        $members[0]['cohortid']= $cohort_idnumber;
        $members[0]['userid']= $user_idnumber;
        $members[0]['type']='idnumber';
        $request= $this->request('core_cohort_delete_cohort_members', drupal_http_build_query(array('members'=>$members)) );
        return $request;
    }
}