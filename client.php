<?php
// This file is NOT a part of Moodle - http://moodle.org/
//
// This client for Moodle 2 is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//

/**
 * REST client for Moodle 2
 * Return JSON or XML format
 *
 * @authorr Jerome Mouneyrac
 */

/// SETUP - NEED TO BE CHANGED
$token = '2bbc8414d1b551dfc834c5d88aef8688';
$domainname = 'https://test.online-gymnasium.ru';
$create_users = 'core_user_create_users';
$get_cohort_members = 'core_cohort_add_cohort_members';



// REST RETURNED VALUES FORMAT
$restformat = 'json'; //Also possible in Moodle 2.2 and later: 'json'
                     //Setting it to 'json' will fail all calls on earlier Moodle version

//////// moodle_user_create_users ////////

/// PARAMETERS - NEED TO BE CHANGED IF YOU CALL A DIFFERENT FUNCTION
//$user1 = new stdClass();
//$user1->username = 'testusername1';
//$user1->password = 'testpassword1';
//$user1->firstname = 'testfirstname1';
//$user1->lastname = 'testlastname1';
//$user1->email = 'testemail1@moodle.com';
//$user1->auth = 'manual';
//$user1->idnumber = 'testidnumber1';
//$user1->lang = 'en';
//$user1->theme = 'standard';
//$user1->timezone = '-12.5';
//$user1->mailformat = 0;
//$user1->description = 'Hello World!';
//$user1->city = 'testcity1';
//$user1->country = 'au';
//$preferencename1 = 'preference1';
//$preferencename2 = 'preference2';
//$user1->preferences = array(
//    array('type' => $preferencename1, 'value' => 'preferencevalue1'),
//    array('type' => $preferencename2, 'value' => 'preferencevalue2'));
$user2 = new stdClass();
$user3 = new stdClass();
$user2->username = 'testusername7';
$user2->password = 'Pendalf121#';
$user2->firstname = 'testfirstname7';
$user2->lastname = 'testlastname7';
$user2->email = 'testemail7@moodle.com';
$user2->timezone = 'Pacific/Port_Moresby';
$users = array($user2);
$paramsUser = array('users' => $users);

$members[0]['cohorttype']['type']= 'cohortid' ;
$members[0]['cohorttype']['value']= '100';
$members[0]['usertype']['type']= 'userid';
$members[0]['usertype']['value']= '3';

$paramsCohor=  array('members'=>$members);

/// REST CALL
header('Content-Type: text/plain');
$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$get_cohort_members;
require_once('./curl.php');
$curl = new curl;
//if rest format == 'xml', then we do not add the param for backward compatibility with Moodle < 2.2
$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
//$resp  = $curl->post($serverurl . $restformat, $paramsUser);
$resp  = $curl->post($serverurl . $restformat, $paramsCohor);
print_r($resp);
