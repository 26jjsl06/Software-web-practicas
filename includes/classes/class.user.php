<?php

class User extends App {


    public static function add($data) {
    	global $database;
    	$email = strtolower($data['email']);
    	$count = $database->count("people",["email" => $email]);
    	if ($count == "1") { return "11"; }

        $fcmtoken = "";
        if(isset($data['fcmtoken'])) $fcmtoken = $data['fcmtoken'];

        $ldapuser = "";
        if(isset($data['ldap_user'])) $ldapuser = $data['ldap_user'];

    	$password = sha1($data['password']);
    	$lastid = $database->insert("people", [
    		"name" => $data['name'],
    		"type" => "user",
    		"roleid" => $data['roleid'],
    		"clientid" => $data['clientid'],
    		"email" => $email,
            "ldap_user" => $ldapuser,
    		"title" => $data['title'],
    		"mobile" => $data['mobile'],
    		"password" => $password,
    		"theme" => "skin-blue",
    		"sidebar" => "opened",
    		"layout" => "",
    		"notes" => "",
    		"signature" => "",
    		"sessionid" => "",
    		"resetkey" => "",
    		"autorefresh" => 0,
    		"lang" => getConfigValue("default_lang"),
    		"ticketsnotification" => 0,
    		]);
    	if ($lastid == "0") { return "11"; } else {
    		if(isset($data['notification'])) { if($data['notification'] == true) Notification::newUser($lastid,$data['password']); }
    		logSystem("User Added - ID: " . $lastid);
    		return "10";
    	}
    }

    public static function edit($data) {
    	global $database;

        $fcmtoken = getSingleValue("people","fcmtoken", $data['id']) ;
        if(isset($data['fcmtoken'])) $fcmtoken = $data['fcmtoken'];

    	$email = strtolower($data['email']);
    	if ($data['password'] == "") {
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"clientid" => $data['clientid'],
    			"name" => $data['name'],
                "ldap_user" => $data['ldap_user'],
    			"email" => $email,
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"lang" => $data['lang'],
                "fcmtoken" => $fcmtoken,

    			],["id" => $data['id']]);
    		logSystem("User Edited - ID: " . $data['id']);
    		return "20";
    	}
    	else {
    		$password = sha1($data['password']);
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"clientid" => $data['clientid'],
    			"name" => $data['name'],
    			"email" => $email,
                "ldap_user" => $data['ldap_user'],
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"password" => $password,
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"lang" => $data['lang'],
                "fcmtoken" => $fcmtoken,

    			],["id" => $data['id']]);
    		logSystem("User Edited - ID: " . $data['id']);
    		return "20";
    	}
    }

    public static function delete($id) {
    	global $database;
        $database->delete("people", [ "id" => $id ]);
    	logSystem("User Deleted - ID: " . $id);
    	return "30";
    }

}


?>
