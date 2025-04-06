<?php 
namespace Controllers\Requisas;

use Controllers\PrivateController;
use Dao\Requisas\RolesD;
use Views\Renderer;

class RolesList extends PrivateController{
    public function run(): void{
        $rolesD=RolesD::obtenerRoles();
        $viewRoles=[];
        

        foreach($rolesD as $rol){
            $viewrol[]=$rol;
        }
        $viewData=[
            "roles"=>$viewrol
        ];
        Renderer::render('requisas/roleslist',$viewData);
    }
}

?>