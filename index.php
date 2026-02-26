<?php
$title_page = "Ec0m - Accueil";
require_once("scripts/connexion.php");

include("template/head.phtml");
include("template/header.phtml");

// Initialisation of products

$data = SelectConnectionPDO("SELECT * FROM products");
if ($data !== null) {
    include("template/index.phtml");
} else {
    echo '<h2>Une erreur inattendue s\'est produite.</h2>';
}
include("template/footer.phtml");
