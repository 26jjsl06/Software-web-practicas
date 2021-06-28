            <?php
#################
## time_log




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewTime");

        if(empty($filters)) {
            $result = $database->select("timelog", "*");
        } else {
            $result = $database->select("timelog", "*", [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['issues'] = unserialize($item['issues']);
            $result[$i]['tickets'] = unserialize($item['tickets']);
            $i++;
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addTime");

        $status = Timelog::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;

    case 'edit':
        isAuthorizedApi("editTime");

        $status = Timelog::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha actualizado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo actualizar el artículo." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteTime");

        $status = Timelog::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha eliminado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Método de solicitud " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
