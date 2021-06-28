<?php
#################
## Clients




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewClients");

        if(empty($filters)) {
            $result = $database->select("clients", "*");
        } else {
            $result = $database->select("clients", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addClient");

        $status = Client::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("editClient");

        $status = Client::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo actualizar el artículo." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteClient");

        $status = Client::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
