<?php  

namespace Controllers\Requisas;

use Controllers\PublicController;
use Dao\Requisas\Requisas;
use Views\Renderer;
use Utilities\Site;

const SESSION_REQUISAS_SEARCH = "requisas_search_data";

class BuscarRequisas extends PublicController 
{
    public function run(): void 
    {
        $viewData = [];
        $viewData["search"] = $this->getSessionSearchData();
        
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
            Site::redirectTo("index.php?page=Requisas-BuscarRequisas");
            return;
        }
        
        if (!empty(trim($viewData["search"]))) {
            $viewData["requisas"] = Requisas::obtenerRequisaPorRequester($viewData["search"]);
        } else {
            $viewData["requisas"] = Requisas::obtenerRequisas();
        }
        
        Renderer::render('requisas/buscarrequisas', $viewData);
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