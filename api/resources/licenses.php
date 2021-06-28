<?php
#################
## Assets




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewLicenses");

        if(empty($filters)) {
            $result = $database->select("licenses", "*");
        } else {
            $result = $database->select("licenses", "*", [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['serial'] = encrypt_decrypt('decrypt', $item['serial']);
            $result[$i]['customfields'] = unserialize($item['customfields']);
            $i++;
        }


        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addLicense");

        $status = License::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento se agrego correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("editLicense");

        $status = License::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se actualizo correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteLicense");

        $status = License::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elementoo." ];
    break;
}





?>
