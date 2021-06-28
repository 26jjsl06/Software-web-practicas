<?php
#################
## kb_articles




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewKB");

        if(empty($filters)) {
            $result = $database->select("kb_articles", "*");
        } else {
            $result = $database->select("kb_articles", "*", [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['clients'] = unserialize($item['clients']);
            $i++;
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addKB");

        $status = Kb::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("editKB");

        $status = Kb::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteKB");

        $status = Kb::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
