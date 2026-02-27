<?php
$title_page = "Ec0m - Modifier un produit";
require_once('template/base.html.phtml');
require_once('model/product.model.php');

if (!isAuthenticated()) {
    header('Location: /login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /product.php');
    exit;
}
$id = intval($_GET['id']);
$product = getProduct($id);
function handleForm(&$product, &$id): bool
{
    if (isset($_POST['title'], $_POST['description'], $_POST['price']) && isset($_FILES['image'])) {
        $title = htmlentities(trim($_POST['title']), ENT_QUOTES, 'UTF-8');
        $description = htmlentities(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
        $price = floatval($_POST['price']);
        $image = $_FILES['image'];

        if (empty($title) || empty($description) || $price <= 0) {
            $title = $product['title'];
            $description = $product['description'];
            $price = $product['price'];
        }
        $imagePath = $product['image_path'];
        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/images/';
            $imageName = html_entity_decode(strtolower(str_replace(' ', '_', $title))) . '_' . time() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
            $imagePath = $uploadDir . $imageName;
            move_uploaded_file($image['tmp_name'], $imagePath);
        } elseif($image['error'] !== UPLOAD_ERR_NO_FILE) {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }

        updateProduct($id, $title, $description, $price, $imagePath);
        header('Location: /product.php');
        exit;
    }
    return false;
}

handleForm($product, $id);

// View

require_once("template/product/edit.phtml");

require_once("template/footer.phtml");
