<?php

namespace Controllers\Requisas;

use Controllers\PublicController;
use Utilities\Validators;
use Views\Renderer;
use Utilities\Site;
use Dao\Requisas\Requisas;

class RequisasForm extends PublicController
{
    private $viewData = [];
    private $modeDscArr = [
        "INS" => "New Requisition",
        "UPD" => "Update Requisition %s",
        "DSP" => "Showing Requisition %s"
    ];
    private $mode = '';

    private $errors = [];

    private $xssToken = '';

    private function addError($error, $context='')
    {
        if (isset($this->errors[$context])){
            $this->errors[$context][] = $error;
        } else {
            $this->errors[$context] = [$error];
        }
    }

    private $requisa = [
        "codigo" => null,
        "date_requested" => null,
        "name_requester" => '',
        "department" => '',
        "quantity" => 0,
        "item" => '',
        "unit_cost" => 0,
        "total" => 0,
        "department_approval" => 0,
        "director_approval" => 0,
        "date_received" => null,
        "received_by" => '',
        "status" => 'ACT',
        "store" => ''
    ];

    public function run(): void
    {
        $this->inicializarForm();
        if ($this->isPostBack()) {
            $this->cargarDatosDelFormulario();
            if($this->validarDatos()){
                $this->procesarAccion();
            }
        }
        $this->generarViewData();
        Renderer::render('requisas/requisas_form', $this->viewData);
        if (isset($_POST["btnCancelar"])) {
            $returnPage = $_SESSION["return_page"] ?? "Requisas-MostrarRequisas";
            Site::redirectTo("index.php?page=" . $returnPage);
        }
        $_SESSION["return_page"] = $_GET["from"] ?? "Requisas-MostrarRequisas";
    }

    private function inicializarForm()
    {
        if (isset($_GET["mode"]) && isset($this->modeDscArr[$_GET["mode"]])) {
            $this->mode = $_GET["mode"];
        } else {
            Site::redirectToWithMsg("index.php?page=Requisas-MostrarRequisas", "Something Went Wrong, Try Again.");
            die();
        }
        if ($this->mode !== 'INS' && isset($_GET["codigo"])) {
            $this->requisa["codigo"] = $_GET["codigo"];
            $this->cargarDatosRequisa();
        }
    }
    private function cargarDatosRequisa()
    {
        $tmpRequisa = Requisas::obtenerRequisaPorId($this->requisa["codigo"]);
        $this->requisa = $tmpRequisa;
    }

    private function cargarDatosDelFormulario()
    {
        $this->requisa["name_requester"] = $_POST["name_requester"];
        $this->requisa["department"] = $_POST["department"];
        $this->requisa["quantity"] = intval($_POST["quantity"]);
        $this->requisa["item"] = $_POST["item"];
        $this->requisa["unit_cost"] = floatval($_POST["unit_cost"]);
        $this->requisa["total"] = floatval($_POST["total"]);
        $this->requisa["department_approval"] = isset($_POST["department_approval"]) ? 1 : 0;
        $this->requisa["director_approval"] = isset($_POST["director_approval"]) ? 1 : 0;
        if (isset($_POST["date_received"]) && !empty($_POST["date_received"])) {
            $this->requisa["date_received"] = date('Y-m-d H:i:s', strtotime($_POST["date_received"]));
        } else {
            $this->requisa["date_received"] = null;
        }
        $this->requisa["received_by"] = $_POST["received_by"];
        $this->requisa["store"] = $_POST["store"];

        $this->xssToken = $_POST["xssToken"];
    }

    private function validarDatos(){
        if(!$this->validarAntiXSSToken()){
            \Utilities\Site::redirectToWithMsg('index.php?page=Requisas-MostrarRequisas', "There was an error processing this request.");
        }
        if (Validators::IsEmpty($this->requisa["name_requester"])) {
            $this->addError("This field cannot be empty.", "name_requester");
        }
        if (Validators::IsEmpty($this->requisa["department"])) {
            $this->addError("This field cannot be empty.", "department");
        }
        if ($this->requisa["quantity"] <= 0) {
            $this->addError("Please insert a value above 0.", "quantity");
        }
        if (Validators::IsEmpty($this->requisa["item"])) {
            $this->addError("This field cannot be empty.", "item");
        }
        if ($this->requisa["unit_cost"] <= 0) {
            $this->addError("Please insert a value above 0.", "unit_cost");
        }
        if ($this->requisa["total"] <= 0) {
            $this->addError("Please insert a value above 0.", "total");
        }
        if (Validators::IsEmpty($this->requisa["store"])) {
            $this->addError("This field cannot be empty.", "store");
        }
        return count($this->errors) === 0;
    }

    private function procesarAccion()
    {
        switch ($this->mode) {
            case 'INS':
                $result = Requisas::agregarRequisa($this->requisa);
                if ($result) {
                    Site::redirectToWithMsg("index.php?page=Requisas-MostrarRequisas", "Requisition submitted successfully.");
                }
                break;
            case 'UPD':
                $result = Requisas::actualizarRequisa($this->requisa);
                if ($result) {
                    Site::redirectToWithMsg("index.php?page=Requisas-MostrarRequisas", "Requisition updated successfully.");
                }
                break;
        }
    }

    private function generateAntiXSSToken(){
        $_SESSION["Requisas_Form_XSST"] = hash("sha256", time()."REQUISA_FORM");
        $this->xssToken = $_SESSION["Requisas_Form_XSST"];
    }

    private function validarAntiXSSToken(){
        if(isset($_SESSION["Requisas_Form_XSST"])) {
            if($this->xssToken === $_SESSION["Requisas_Form_XSST"]){
                return true;
            }
        }
        return false;
    }

    private function generarViewData()
    {
        $this->viewData["mode"] = $this->mode;

        $this->viewData["modes_dsc"] = sprintf(
            $this->modeDscArr[$this->mode],
            $this->requisa["codigo"]
        );
        $this->viewData["requisa"] = $this->requisa;
        $this->viewData["showID"] = ($this->viewData["mode"] != 'INS');
        $this->viewData["readonly"] = 
            ($this->viewData["mode"] === 'DSP' 
        ) ? 'readonly': '';
        $this->viewData["disabled"] = 
            ($this->viewData["mode"] === 'DSP' 
        ) ? 'disabled': '';
        foreach($this->errors as $context=>$errores) {
            $this->viewData[$context .'_error'] = $errores;
            $this->viewData[$context . '_haserror'] = count($errores) > 0;
        }
        $this->viewData["showSubmit"] = ($this->viewData["mode"] != 'DSP');
        $this->generateAntiXSSToken();
        $this->viewData["xssToken"] = $this->xssToken;
    }
}
