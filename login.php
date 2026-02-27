<?php
$title_page = "Ec0m - Se connecter";
$error_message = "";
require_once("model/user.model.php");

require_once('template/base.html.phtml');



function login(&$error_message)
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = LoginUser($email, $password);
        if ($user !== null) {
            setSessionUser($user['email'], $user['username']);
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Identifiants invalides. Veuillez réessayer.";
        }
    }
}

login($error_message);

require_once("template/login/index.phtml");


require_once("template/footer.phtml");
