<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecom", "root", "root");
$sql = "SELECT * FROM products";

$select = $pdo->prepare($sql);

$select->execute();

$data = $select->fetchAll(PDO::FETCH_ASSOC);
