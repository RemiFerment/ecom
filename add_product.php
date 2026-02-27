<?php
require_once('model/product.model.php');
require_once('model/auth.php');
$title_page = "Ec0m - Ajouter un produit";

if (!isAuthenticated()) {
    header('Location: /login.php');
    exit;
}

function handleForm(): bool
{
    if (isset($_POST['title'], $_POST['description'], $_POST['price']) && isset($_FILES['image'])) {
        $title = htmlentities(trim($_POST['title']), ENT_QUOTES, 'UTF-8');
        $description = htmlentities(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
        $price = floatval($_POST['price']);
        $image = $_FILES['image'];

        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $imageName = html_entity_decode(strtolower(str_replace(' ', '_', $title))) . '_' . time() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
            $imagePath = $uploadDir . $imageName;
            move_uploaded_file($image['tmp_name'], $imagePath);
            return addProduct($title, $description, $price, $imagePath);
        } else {
            echo '<h2>Erreur lors du téléchargement de l\'image.</h2>';
            return false;
        }
    }
    return false;
}

handleForm();

// View
require_once('template/base.html.phtml');

require_once("template/product/add.phtml");

require_once("template/footer.phtml");
