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
require_once('./curl.php');

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



function getServerurl($getMetod)
{
    $token = '2bbc8414d1b551dfc834c5d88aef8688';
    $domainname = 'https://test.online-gymnasium.ru';
    $serverurl = $domainname . '/webservice/rest/server.php' . '?wstoken=' . $token . '&wsfunction=' . $getMetod;
    return $serverurl;
}

function getRestformat()
{
    $restformat = 'json'; //Also possible in Moodle 2.2 and later: 'json' or 'xml'
    $restformat = ($restformat == 'json') ? '&moodlewsrestformat=' . $restformat : '';
    return $restformat;
}

function add_cohort_members()
{
    $curl = new curl;

    $members[0]['cohorttype']['type'] = 'idnumber';
    $members[0]['cohorttype']['value'] = '123';
    $members[0]['usertype']['type'] = 'id';
    $members[0]['usertype']['value'] = '5';
    $paramsCohor = array('members' => $members);

    $serverurl = getServerurl('core_cohort_add_cohort_members');
    $restformat = getRestformat();
    $resp = $curl->post($serverurl . $restformat, $paramsCohor);
    return $resp;
}
function create_users()
{
    $user2 = new stdClass();
    $curl = new curl;

    $user2->username = 'testusername8';
    $user2->password = 'Pendalf121#';
    $user2->firstname = 'testfirstname8';
    $user2->lastname = 'testlastname8';
    $user2->email = 'testemail8@moodle.com';
    $user2->timezone = 'Pacific/Port_Moresby';
    $users = array($user2);
    $paramsUser = array('users' => $users);

    $serverurl = getServerurl('core_user_create_users');
    $restformat = getRestformat();
    $resp = $curl->post($serverurl . $restformat, $paramsUser);
    return $resp;
}
function getIdUser()
{
    $user2 = new stdClass();
    $curl = new curl;

    $criteria[0]['key']= 'id';
    $criteria[0]['value']= '2';
    $paramsUser= array('criteria' => $criteria);

    $serverurl = getServerurl('core_user_get_users');
    $restformat = getRestformat();
    $resp = $curl->post($serverurl . $restformat, $paramsUser);
    return $resp;
}

/// REST CALL
header('Content-Type: text/plain');
//$user = create_users();
//$cohor = add_cohort_members();
$id = getIdUser();
//echo $user;
echo "<br/>";
//echo $cohor;
echo "<br/>";
echo $id;

