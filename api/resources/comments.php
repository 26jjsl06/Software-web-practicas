<?php
#################
## comments




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewComments");

        if(empty($filters)) {
            $result = $database->select("comments", "*");
        } else {
            $result = $database->select("comments", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addComment");

        $status = Comment::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("editComment");

        $status = Comment::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo actualizar el artículo." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteComment");

        $status = Comment::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
