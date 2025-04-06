<?php
namespace Controllers\Sec;
class Login extends \Controllers\PublicController
{
    private $txtEmail = "";
    private $txtPswd = "";
    private $errorEmail = "";
    private $errorPswd = "";
    private $generalError = "";
    private $hasError = false;

    public function run() :void
    {
        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];

            if (!\Utilities\Validators::IsValidEmail($this->txtEmail)) {
                $this->errorEmail = "Please enter a valid email address";
                $this->hasError = true;
            }
            if (\Utilities\Validators::IsEmpty($this->txtPswd)) {
                $this->errorPswd = "You must enter a password";
                $this->hasError = true;
            }
            if (! $this->hasError) {
                if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                    if ($dbUser["userest"] != \Dao\Security\Estados::ACTIVO) {
                        $this->generalError = "Incorrect credentials. Please try again.";
                        $this->hasError = true;
                        error_log(
                            sprintf(
                                "ERROR: %d %s Your account is currently %s",
                                $dbUser["usercod"],
                                $dbUser["useremail"],
                                $dbUser["userest"]
                            )
                        );
                    }
                    if (!\Dao\Security\Security::verifyPassword($this->txtPswd, $dbUser["userpswd"])) {
                        $this->generalError = "Incorrect credentials. Please try again.";
                        $this->hasError = true;
                        error_log(
                            sprintf(
                                "ERROR: %d %s The password you entered is incorrect.",
                                $dbUser["usercod"],
                                $dbUser["useremail"]
                            )
                        );
                        // Aqui se debe establecer acciones segun la politica de la institucion.
                    }
                    if (! $this->hasError) {
                        \Utilities\Security::login(
                            $dbUser["usercod"],
                            $dbUser["username"],
                            $dbUser["useremail"]
                        );
                        if (\Utilities\Context::getContextByKey("redirto") !== "") {
                            \Utilities\Site::redirectTo(
                                \Utilities\Context::getContextByKey("redirto")
                            );
                        } else {
                            \Utilities\Site::redirectTo("index.php");
                        }
                    }
                } else {
                    error_log(
                        sprintf(
                            "ERROR: %s tried to enter",
                            $this->txtEmail
                        )
                    );
                    $this->generalError = "Incorrect credentials. Please try again.";
                }
            }
        }
        $dataView = get_object_vars($this);
        \Views\Renderer::render("security/login", $dataView);
    }
}
?>
