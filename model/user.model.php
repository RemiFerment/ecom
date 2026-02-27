<?php
include('model/connexion.php');

function addUser(string $email, string $password, string $username): bool
{
    $pdo = ConnectionPDO();
    if ($pdo !== null) {
        $sql = "INSERT INTO user (email,password,username) VALUES (:email,:password,:username);";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        $statement->bindValue(':username', $username);
        if ($statement->execute()) {
            return true;
        }
    }

    return false;
}


function LoginUser(string $email, string $password): ?array
{
    $pdo = ConnectionPDO();
    if ($pdo !== null) {
        $sql = "SELECT * FROM user WHERE email=:email ;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $email);
        if ($statement->execute()) {
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            if ($data && password_verify($password, $data['password'])) {
                return [$data['email'], $data['username']];
            }
        }
    }
    return null;
}

function UpdateUser(int $id, string $email, string $password, string $username){
    
}