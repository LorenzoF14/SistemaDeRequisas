<?php  

namespace Controllers\Requisas;

use Controllers\PublicController;
use Dao\Requisas\Requisas;
use Views\Renderer;

class MostrarRequisas extends PublicController 
{
    public function run(): void 
    {
        if (isset($_GET["cambiarEstado"]) && isset($_GET["estado"])) {
            $codigo = $_GET["cambiarEstado"];
            $estado = $_GET["estado"];
            Requisas::cambiarEstadoRequisa($codigo, $estado);
            \Utilities\Site::redirectTo("index.php?page=Requisas-MostrarRequisas");
        }
        $orderByStore = isset($_GET['orderByStore']) ? !$_GET['orderByStore'] : false;
        $requisasDao = Requisas::obtenerRequisasPorTienda(null, $orderByStore);
        $viewRequisas = [];
        $statusDscArr = [
            "ACT" => "Active",
            "FUL" => "Fullfilled"
        ];
        foreach ($requisasDao as $requisas) {
            if ($requisas["status"] === "ACT") {
                $requisas["statusDsc"] = $statusDscArr[$requisas["status"]];
                $viewRequisas[] = $requisas;
            }
        }
        $viewData = ["requisas" => $viewRequisas,"orderByStore" => $orderByStore];
        Renderer::render('requisas/mostrarrequisas', $viewData);
    }
}