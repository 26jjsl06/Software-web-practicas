<?php
#################
## Assets




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewAssets");

        if(empty($filters)) {
            $result = $database->select("assets", "*");
        } else {
            $result = $database->select("assets", "*", [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['customfields'] = unserialize($item['customfields']);
            $i++;
        }

        $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addAsset");

        $status = Asset::addApi($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("editAsset");

        $status = Asset::editApi($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteAsset");

        $status = Asset::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Success! Item has been delete successfully." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
