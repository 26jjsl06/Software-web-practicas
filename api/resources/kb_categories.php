<?php
#################
## kb_categories




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewKB");

        if(empty($filters)) {
            $result = $database->select("kb_categories", "*");
        } else {
            $result = $database->select("kb_categories", "*", [ "AND" => $filters ]);
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

        $status = Kb::addCategory($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento se agrego correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("editKB");

        $status = Kb::editCategory($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se actualizo correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'detele':
        isAuthorizedApi("deleteKB");

        $status = Kb::deleteCategory($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " No permitido para este elemento." ];
    break;
}





?>
