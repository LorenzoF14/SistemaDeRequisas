<?php

namespace Controllers;

class Error extends PublicController
{
    public function run(): void
    {
        $error_code = \Utilities\Context::getContextByKey("ERROR_CODE");
        $error_code = $error_code === "" ? 404 : $error_code;
        $error_msg = "Something unexpected occurred";
        switch ($error_code) {
            case 404:
                $error_msg = "The requested resource could not be found";
                break;
            case $error_code >= 500:
                $error_msg = "An unexpected error occurred in our service";
                break;
        }
        http_response_code($error_code);
        \Views\Renderer::render(
            "error",
            [
                "CLIENT_ERROR_CODE" => $error_code,
                "CLIENT_ERROR_MSG" => $error_msg
            ]
        );
    }
}
