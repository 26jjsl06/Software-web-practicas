<?php
#################
## Milestones




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewMilestones");

        if(empty($filters)) {
            $result = $database->select("milestones", "*");
        } else {
            $result = $database->select("milestones", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Exito!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addMilestone");

        $status = Milestone::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Exito! El elemento se agrego correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo agregar el elemento." ];
    break;

    case 'edit':
        isAuthorizedApi("editMilestone");

        $status = Milestone::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Exito! El elemento se actualizo correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo actualizar el elemento." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteMilestone");

        $status = Milestone::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Exito! El elemento se elimino correctamente." ];
        else $response = [ "status" => 2, "status_message" => "Error! No se pudo eliminar el elemento." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " no permitido para este elemento." ];
    break;
}





?>
