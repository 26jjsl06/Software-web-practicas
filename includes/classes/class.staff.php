<?php

class Staff extends App {

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
    		"type" => "admin",
    		"roleid" => $data['roleid'],
    		"clientid" => "0",
    		"name" => $data['name'],
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
    		"ticketsnotification" => 1,

    		]);
    		if ($lastid == "0") { return "11"; } else {
    			if(isset($data['notification'])) { if($data['notification'] == true) Notification::newUser($lastid,$data['password']); }
    			logSystem("Staff Account Added - ID: " . $lastid);
    			return "10";
    		}
    }

    public static function edit($data) {
    	global $database;
    	$email = strtolower($data['email']);

        $fcmtoken = getSingleValue("people","fcmtoken", $data['id']) ;
        if(isset($data['fcmtoken'])) $fcmtoken = $data['fcmtoken'];

    	if ($data['password'] == "") {
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"name" => $data['name'],
    			"email" => $email,
                "ldap_user" => $data['ldap_user'],
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"signature" => $data['signature'],
    			"lang" => $data['lang'],
    			"ticketsnotification" => $data['ticketsnotification'],
                "fcmtoken" => $fcmtoken,

    			],["id" => $data['id']]);
    		logSystem("Staff Account Edited - ID: " . $data['id']);
    		return "20";
    		}
    	else {
    		$password = sha1($data['password']);
    		$database->update("people", [
    			"roleid" => $data['roleid'],
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
    			"signature" => $data['signature'],
    			"lang" => $data['lang'],
    			"ticketsnotification" => $data['ticketsnotification'],
                "fcmtoken" => $fcmtoken,

    			],["id" => $data['id']]);
    		logSystem("Staff Account Edited - ID: " . $data['id']);
    		return "20";
    		}

    }

    public static function delete($id) {
    	global $database;
        $database->delete("people", [ "id" => $id ]);
    	logSystem("Staff Account Deleted - ID: " . $id);
    	return "30";
    }

}


?>