<?php  

namespace Controllers\Requisas;

use Controllers\PublicController;
use Views\Renderer;

class NuevaRequisa extends PublicController {
    public function run() :void {
        $viewData = [
            "nombre_solicitante"=>'Jose Flores',
            "items"=> [
                [
                    "producto"=>"Abrazaderas",
                    "cantidad"=>"5"
                ],
                [
                    "producto"=>"Mouse",
                    "cantidad"=>"3"
                ],
                [
                    "producto"=>"Teclado",
                    "cantidad"=>"8"
                ],
            ]
        ];

        if( $this->isPostBack()) {
            $txtProducto = $_POST["txtProducto"];
            $txtCantidad = $_POST["txtCantidad"];
            $rsltMessage = $txtProducto . "Guardado.";
            $viewData["txtProducto"] = $txtProducto;
            $viewData["txtCantidad"] = $txtCantidad;
            $viewData["rsltMessage"] = $rsltMessage;
        }

        Renderer::render('Requisas/NuevaRequisa', $viewData);
    }
}