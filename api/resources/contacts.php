<?php
#################
## contacts




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewContacts");

        if(empty($filters)) {
            $result = $database->select("contacts", "*");
        } else {
            $result = $database->select("contacts", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addContact");

        $status = Contact::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El articulo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("editContact");

        $status = Contact::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el artículo." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteContact");

        $status = Contact::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo borrar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Metodo de solicitud " . $request_method . " No permitido para este recurso." ];
    break;
}





?>
