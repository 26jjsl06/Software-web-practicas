<?php
#################
## authenticate




switch ($request_method) {
    case 'get':
        //isAuthorizedApi("manageData");

        if(empty($filters)) {
            $response = [ "status" => 0, "status_message" => "Fallo de autentificacion" ];
        } else {
            $peopleid = signInApi($filters['username'],$filters['password']);


            if($peopleid != 0) {
                $result = $database->get("people","*",["id" => $peopleid]);
                $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
            } else {
                $response = [ "status" => 0, "status_message" => "Fallo de autentificacion" ];
            }
        }


    break;





    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
