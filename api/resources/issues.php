<?php
#################
## issues




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewIssues");

        if(empty($filters)) {
            $result = $database->select("issues", "*");
        } else {
            $result = $database->select("issues", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addIssue");

        $status = Issue::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento esta agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("editIssue");

        $status = Issue::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se actualizo correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteIssue");

        $status = Issue::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Metodo de recursos " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
