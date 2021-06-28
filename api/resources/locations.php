<?php
#################
## locations




switch ($request_method) {
    case 'get':
        isAuthorizedApi("manageData");

        if(empty($filters)) {
            $result = $database->select("locations", "*");
        } else {
            $result = $database->select("locations", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("manageData");

        $status = Attribute::addLocation($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento es agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("manageData");

        $status = Attribute::editLocation($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se actualizo correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("manageData");

        $status = Attribute::deleteLocation($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
