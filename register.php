<?php
require_once('model/user.model.php');
$title_page = "Ec0m - S'inscrire";
$error_message = "";

// Controller
/**
 * Handle user registration
 * Validate data and display error messages if necessary
 * Redirect to login page if registration is successful
 * @param string $error_message Reference to the error message variable to update with any validation errors
 */
function Register(string &$error_message)
{
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['confirm_password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $confirm_password = $_POST['confirm_password'];

        // Data validation
        $validData = true;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message .= "L'adresse email n'est pas valide.<br>";
            $validData = false;
        }
        if (strlen($password) < 6) {
            $error_message .= "Le mot de passe doit contenir au moins 6 caractères.<br>";
            $validData = false;
        }
        if (strlen($username) < 3) {
            $error_message .= "Le pseudonyme doit contenir au moins 3 caractères.<br>";
            $validData = false;
        }
        if ($password !== $confirm_password) {
            $error_message .= "Les mots de passe ne correspondent pas.<br>";
            $validData = false;
        }
        // Stop if data is not valid
        if (!$validData) {
            return;
        }

        // Add user to database
        if (addUser($email, $password, $username)) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Une erreur est survenue lors de l'inscription.";
        }
    }
}

Register($error_message);

// View
require_once('template/base.html.phtml');

require_once("template/register/index.phtml");

require_once("template/footer.phtml");
