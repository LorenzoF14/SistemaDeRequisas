<?php  

namespace Controllers\Requisas;

use Controllers\PublicController;
use Dao\Requisas\Requisas;
use Views\Renderer;

class MostrarRequisas extends PublicController 
{
    public function run(): void 
    {
        $requisasDao = Requisas::obtenerRequisas();
        $viewRequisas = [];
        $estadosDscArr = [
            "ACT" => "Active",
            "FUL" => "Fullfilled"
        ];
        foreach ($requisasDao as $requisas){
            //$requisas["estadoDsc"] = $estadosDscArr[$requisas["estado"]];
            $viewRequisas[] = $requisas;
        }
        $viewData = [
            "requisas" => $viewRequisas
        ];
        Renderer::render('requisas/mostrarrequisas',$viewData);
    }
}