<?php
#################
## files




switch ($request_method) {
    case 'get':
        isAuthorizedApi("manageData");

        if(empty($filters)) {
            $result = $database->select("files", "*");
        } else {
            $result = $database->select("files", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("manageData");

        $status = File::upload($data,$_FILES);

        if($status == 9500) $response = [ "status" => 1, "status_message" => "Exito! El elemento se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;


    case 'delete':
        isAuthorizedApi("manageData");

        $status = File::delete($id);

        if($status == 9503) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
