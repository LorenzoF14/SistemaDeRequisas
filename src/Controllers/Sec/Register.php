<?php

namespace Controllers\Sec;

use Controllers\PublicController;
use \Utilities\Validators;
use Exception;

class Register extends PublicController
{
    private $txtEmail = "";
    private $txtPswd = "";
    private $errorEmail ="";
    private $errorPswd = "";
    private $hasErrors = false;
    public function run() :void
    {

        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];
            if (!(Validators::IsValidEmail($this->txtEmail))) {
                $this->errorEmail = "Please enter a valid email address";
                $this->hasErrors = true;
            }
            if (!Validators::IsValidPassword($this->txtPswd)) {
                $this->errorPswd = "Your password must be at least 8 characters long and must contain at least one uppercase letter, one number, and one special character.";
                $this->hasErrors = true;
            }

            if (!$this->hasErrors) {
                try{
                    if (\Dao\Security\Security::newUsuario($this->txtEmail, $this->txtPswd)) {
                        \Utilities\Site::redirectToWithMsg("index.php?page=sec_register", "Registration successful!");
                    }
                } catch (\Error $ex){
                    die($ex);
                }
            }
        }
        $viewData = get_object_vars($this);
        \Views\Renderer::render("security/sigin", $viewData);
    }
}
?>
