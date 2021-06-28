<?php
#################
## users




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewStaff");

        $filters['type'] = 'admin';
        $result = $database->select("people", "*", [ "AND" => $filters ]);


        $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addStaff");

        $status = Staff::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("editStaff");

        $status = Staff::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo actualizar el artículo." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteStaff");

        $status = Staff::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Método de solicitud " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
