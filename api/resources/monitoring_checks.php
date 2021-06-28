<?php
#################
## monitoring_checks




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewMonitoring");

        if(empty($filters)) {
            $result = $database->select("hosts_checks", "*");
        } else {
            $result = $database->select("hosts_checks", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("manageHost");

        $status = Monitoring::addCheck($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento se agrego correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("manageHost");

        $status = Monitoring::editCheck($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se actualizo correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("manageHost");

        $status = Monitoring::deleteCheck($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
