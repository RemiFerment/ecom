<?php
require_once('model/connexion.php');

function getAllProduct(): ?array
{
    $pdo = ConnectionPDO();
    return $pdo->query('SELECT * FROM products;')->fetch(PDO::FETCH_ASSOC) ?? null;
}
function getProduct(int $id): ?array
{
    $pdo = ConnectionPDO();
    $sql = "SELECT * FROM products WHERE id=:id;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);
    return $statement->execute() ? $statement->fetch(PDO::FETCH_ASSOC) : null;
}

function addProduct(string $title, string $description, string $price, string $image_path): bool
{
    $pdo = ConnectionPDO();
    $sql = "INSERT INTO products (title,description,price,image_path) VALUES (:title,:description,:price,:image_path);";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':image_path', $image_path);

    return $statement->execute();
}

function updateProduct(int $id, string $title, string $description, string $price, string $image_path): bool
{
    $pdo = ConnectionPDO();
    $sql = "UPDATE products SET title=:title, description=:description, price=:price,image_path=:image_path WHERE id = :id;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':image_path', $image_path);
    $statement->bindValue(':id', $id);

    return $statement->execute();
}

function deleteProduct(int $id): bool
{
    $pdo = ConnectionPDO();
    $sql = "DELETE FROM products WHERE id=:id;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id);

    return $statement->execute();
}
