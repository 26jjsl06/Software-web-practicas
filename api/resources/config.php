<?php
#################
## ticket_departments




switch ($request_method) {
    case 'get':
        isAuthorizedApi("manageSettings");

        if(empty($filters)) {
            $result = $database->select("config", "*");
        } else {
            $result = $database->select("config", "*", [ "AND" => $filters ]);
        }


        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;




    default:
        $response = [ "status" => 907, "status_message" => "Metodo de solicitud" . $request_method . " Este recurso no esta permitido." ];
    break;
}





?>
