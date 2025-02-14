<?php

namespace Controllers\Requisas;

use Controllers\PublicController;
use Views\Renderer;
use Utilities\Site;
use Dao\Requisas\Requisas;

class RequisasForm extends PublicController{
    private $viewData= [];
    private $modeDscArr = [
        "INS" => "New Requisition",
        "UPD" => "Update Requisition %s",
        "DSP" => "Showing Requisition %s"
    ];
    private $mode = '';

    private $requisa = [
        "codigo" => null,
        "date_requested"=> null,
        "name_requester"=> '',
        "department"=> '',
        "quantity"=> 0,
        "item"=> '',
        "unit_cost"=> 0,
        "total"=> 0,
        "department_approval"=> 0,
        "director_approval"=> 0,
        "date_received"=> null,
        "received_by"=> '',
        "status"=> 'ACT'
    ];

    public function run():void
    {
        $this->inicializarForm();
        if($this->isPostBack()){
            $this->cargarDatosDelFormulario();
            $this->procesarAccion();
        }
        $this->generarViewData();
        Renderer::render('requisas/requisas_form', $this->viewData);
    }

    private function inicializarForm(){
        if(isset($_GET["mode"]) && isset($this->modeDscArr[$_GET["mode"]])) {
            $this->mode = $_GET["mode"];
        } else {
            Site::redirectToWithMsg("index.php?page=Requisas-MostrarRequisas", "Something Went Wrong, Try Again.");
            die();
        }
        if($this->mode!=='INS' && isset($_GET["codigo"])){
            $this->requisa["codigo"] = $_GET["codigo"];
            $this->cargarDatosRequisa();
        }
    }
    private function cargarDatosRequisa(){
        $tmpRequisa = Requisas::obtenerRequisaPorId($this->requisa["codigo"]);
        $this->requisa = $tmpRequisa;
    }

    private function cargarDatosDelFormulario()
    {
        $this->requisa["codigo"] = $_POST["codigo"];
        $this->requisa["date_requested"] = $_POST["date_requested"];
        $this->requisa["name_requester"] = $_POST["name_requester"];
        $this->requisa["department"] = $_POST["department"];
        $this->requisa["quantity"] = $_POST["quantity"];
        $this->requisa["item"] = $_POST["item"];
        $this->requisa["unit_cost"] = $_POST["unit_cost"];
        $this->requisa["total"] = $_POST["total"];
        $this->requisa["department_approval"] = $_POST["department_approval"];
        $this->requisa["director_approval"] = $_POST["director_approval"];
        $this->requisa["date_received"] = $_POST["date_received"];
        $this->requisa["received_by"] = $_POST["received_by"];
    }

    private function procesarAccion(){
        switch($this->mode){
            case 'INS':
                $result = Requisas::agregarRequisa($this->requisa);
                break;
            case 'UPD':
        }
    }

    private function generarViewData(){
        $this->viewData["mode"] = $this->mode;

        $this->viewData["modes_dsc"] = sprintf(
            $this->modeDscArr[$this->mode],
            $this->requisa["codigo"]
        );
        $this->viewData["requisa"] = $this->requisa;
    }
}
