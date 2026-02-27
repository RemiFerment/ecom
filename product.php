<?php
$title_page = "Ec0m - Gestion des produits";
require_once('model/product.model.php');

// View
require_once('template/base.html.phtml');
if (!isAuthenticated()) {
    header('Location: /login.php');
    exit;
}
$products = getAllProduct();
require_once('template/product/main.phtml');
require_once('template/footer.phtml');
