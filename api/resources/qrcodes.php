<?php
#################
## manufacturers




switch ($request_method) {
    case 'get':
        isAuthorizedApi("manageData");

        if(empty($filters)) {
            $result = $database->select("qrcodes", "*");
        } else {
            $result = $database->select("qrcodes", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
    break;

    case 'edit':
        isAuthorizedApi("manageData");

        $status = Attribute::editQrcode($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo actualizar el artículo." ];
    break;


    case 'delete':
        isAuthorizedApi("manageData");

        $status = Attribute::deleteQrcode($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;


    case 'attach':
        isAuthorizedApi("manageData");

        $status = Attribute::attachQrcode($data);

        if($status == "10") $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha adjuntado correctamente." ];
        elseif($status == "11") $response = [ "status" => 2, "status_message" => "¡Error! No se puede adjuntar el artículo. Asegúrese de que el código QR se genere y sea gratuito." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se puede adjuntar el artículo." ];
    break;

    case 'detach':
        isAuthorizedApi("manageData");

        $status = Attribute::detachQrcode($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha separado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se puede separar el artículo." ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este recurso." ];
    break;
}





?>