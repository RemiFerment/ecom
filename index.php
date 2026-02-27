<?php
$title_page = "Ec0m - Accueil";

require_once('model/product.model.php');

require_once('template/base.html.phtml');




// Initialisation of products

$data = getAllProduct();
if ($data !== null) {
    require_once("template/index.phtml");
} else {
    echo '<h2>Une erreur inattendue s\'est produite.</h2>';
}


require_once("template/footer.phtml");
