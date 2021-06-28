<?php
#################
## asset_categories




switch ($request_method) {
    case 'get':
        isAuthorizedApi("manageData");

        if(empty($filters)) {
            $result = $database->select("assetcategories", "*");
        } else {
            $result = $database->select("assetcategories", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("manageData");

        $status = Attribute::addAssetCategory($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("manageData");

        $status = Attribute::editAssetCategory($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo actualizar el artículo." ];
    break;

    case 'delete':
        isAuthorizedApi("manageData");

        $status = Attribute::deleteAssetCategory($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Metodo de solicitud " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
