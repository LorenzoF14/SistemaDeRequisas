<?php  
namespace Controllers\Requisas;

use Controllers\PrivateController;
use Dao\Requisas\Requisas;
use Views\Renderer;
use Utilities\Site;

class RequisasAprobadas extends PrivateController 
{
    public function run(): void 
    {
        if (isset($_GET["cambiarEstado"]) && isset($_GET["estado"])) {
            $codigo = $_GET["cambiarEstado"];
            $estado = $_GET["estado"];
            Requisas::cambiarEstadoRequisa($codigo, $estado);
            Site::redirectTo("index.php?page=Requisas-requisasaprobadas");
        }
        $orderByStore = isset($_GET['orderByStore']) ? !$_GET['orderByStore'] : false;
        $requisasAprobadas = Requisas::obtenerRequisasAprobadas();
        if ($orderByStore) {
            usort($requisasAprobadas, function($a, $b) {
                return strcmp($a['store'], $b['store']);
            });
        }
        $statusDscArr = [
            "ACT" => "Active",
            "FUL" => "Fullfilled"
        ];
        foreach ($requisasAprobadas as &$requisa) {
            $requisa["statusDsc"] = $statusDscArr[$requisa["status"]];
        }
        $viewData = [
            "requisas" => $requisasAprobadas,
            "orderByStore" => $orderByStore,
            "FUL_enable" => $this->isFeatureAutorized('requisas_FUL_enabled')
        ];
        Renderer::render('requisas/requisasaprobadas', $viewData);
    }
}