<?php  

namespace Controllers\Requisas;

use Controllers\PrivateController;
use Dao\Requisas\Requisas;
use Views\Renderer;
use Utilities\Site;

const SESSION_REQUISAS_SEARCH = "requisas_search_data";

class BuscarRequisas extends PrivateController 
{
    public function run(): void 
    {
        $currentUser = $this->getCurrentUserName();
        $isAdmin = $this->isAdminUser($currentUser);
        $viewData = [];
        $viewData["search"] = $this->getSessionSearchData();
        $viewData["buscar_enable"] = $this->isFeatureAutorized('requisas_buscar_enabled');
        
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
            Site::redirectTo("index.php?page=Requisas-BuscarRequisas");
            return;
        }

        if (!empty(trim($viewData["search"]))) {
            $viewData["requisas"] = Requisas::obtenerRequisaPorRequester($viewData["search"]);
            if (!$isAdmin) {
                $viewData["requisas"] = array_filter(
                    $viewData["requisas"],
                    fn($r) => $r["name_requester"] === $currentUser
                );
            }
        } else {
            $viewData["requisas"] = Requisas::obtenerRequisasPorUsuario($currentUser, $isAdmin);
        }

        Renderer::render('requisas/buscarrequisas', $viewData);
    }

    private function getCurrentUserName(): string
    {
        return $_SESSION['login']['userName'] ?? '';
    }

    private function isAdminUser(string $username): bool
    {
        return in_array($username, ['Alpha Tosta', 'David De Luna', 'Lorenzo Flores']);
    }

    private function getSearchData() {
        return $_POST["search"] ?? "";
    }

    private function getSessionSearchData() {
        return $_SESSION[SESSION_REQUISAS_SEARCH] ?? "";
    }

    private function setSessionSearchData($search) {
        $_SESSION[SESSION_REQUISAS_SEARCH] = $search;
    }
}