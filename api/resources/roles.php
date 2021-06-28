<?php
#################
## roles




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewRoles");

        if(empty($filters)) {
            $result = $database->select("roles", "*");
        } else {
            $result = $database->select("roles", "*", [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['perms'] = unserialize($item['perms']);
            $i++;
        }

        $response = [ "status" => 1, "status_message" => "¡Éxito!", "result" => $result ];
    break;




    default:
        $response = [ "status" => 907, "status_message" => "Método de solicitud " . $request_method . " no permitido para este recurso." ];
    break;
}





?>
