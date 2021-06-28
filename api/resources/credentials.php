<?php
#################
## Credentials



switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewCredentials");

        if(empty($filters)) {
            $result = $database->select("licenses", "*");
        } else {
            $result = $database->select("licenses", "*", [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['password'] = encrypt_decrypt('decrypt', $item['password']);
            $i++;
        }


        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addCredential");

        $status = Credential::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("editCredential");

        $status = Credential::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteCredential");

        $status = Credential::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo borrar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
