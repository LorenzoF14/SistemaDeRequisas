<?php  

namespace Controllers\Requisas;

use Controllers\PrivateController;
use Dao\Requisas\Requisas;
use Views\Renderer;
use Utilities\Site;

class MostrarRequisas extends PrivateController
{
    public function run(): void
    {
        $currentUser = $this->getCurrentUserName();
        $isAdmin = $this->isAdminUser($currentUser);

        if (isset($_GET["cambiarEstado"]) && isset($_GET["estado"])) {
            $codigo = $_GET["cambiarEstado"];
            $estado = $_GET["estado"];
            Requisas::cambiarEstadoRequisa($codigo, $estado);
            Site::redirectTo("index.php?page=Requisas-MostrarRequisas");
        }

        $orderByStore = isset($_GET['orderByStore']) ? !$_GET['orderByStore'] : false;
        $requisasDao = Requisas::obtenerRequisasPorTienda(null, $orderByStore);

        $viewRequisas = [];
        $statusDscArr = [
            "ACT" => "Active",
            "FUL" => "Fullfilled"
        ];

        foreach ($requisasDao as $requisas) {
            if ($requisas["status"] === "ACT" && ($isAdmin || $requisas["name_requester"] === $currentUser)) {
                $requisas["statusDsc"] = $statusDscArr[$requisas["status"]];
                $viewRequisas[] = $requisas;
            }
        }

        $viewData = [
            "requisas" => $viewRequisas,
            "orderByStore" => $orderByStore,
            "FUL_enable" => $this->isFeatureAutorized('requisas_FUL_enabled')
        ];

        Renderer::render('requisas/mostrarrequisas', $viewData);
    }

    private function getCurrentUserName(): string
    {
        return $_SESSION['login']['userName'] ?? '';
    }

    private function isAdminUser(string $username): bool
    {
        return in_array($username, ['Alpha Tosta', 'David De Luna', 'Lorenzo Flores']);
    }
}