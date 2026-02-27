<?php
require_once('model/product.model.php');
require_once('model/auth.php');
$title_page = "Ec0m - Supression en cours...";

if (!isAuthenticated()) {
    header('Location: /login.php');
    exit;
}

function handle(): bool
{
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: /product.php');
        exit;
    }
    $id = intval($_GET['id']);
    if (deleteProduct($id)) {
        header('Location: /product.php');
        exit;
    } else {
        echo '<h2>Erreur lors de la suppression du produit.</h2>';
        return false;
    }
}

handle();

// View
require_once('template/base.html.phtml');

require_once("template/footer.phtml");
