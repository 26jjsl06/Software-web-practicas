<?php
#################
## system_log




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewTime");

        if(empty($filters)) {
            $result = $database->select("systemlog", "*");
        } else {
            $result = $database->select("systemlog", "*", [ "AND" => $filters ]);
        }


        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addTime");

        $status = logSystemApi($data);


        if($status == 10) $response = [ "status" => 1, "status_message" => "¡Éxito! El artículo se ha agregado correctamente." ];
        else $response = [ "status" => 2, "status_message" => "¡Error! No se pudo agregar el artículo." ];
    break;




    default:
        $response = [ "status" => 907, "status_message" => "Método de solicitud " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
