<?php
function getUserBySession(): array|bool
{
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        return $user;
    }
    return false;
}

function isAuthenticated(): bool
{
    session_start();
    return isset($_SESSION['user']);
}

function logout(): void
{
    session_start();
    session_destroy();
    $_SESSION = [];
    header('Location: /');
    exit;
}

function setSessionUser(string $email, string $username): void
{
    session_start();
    $_SESSION['user'] = [
        'email' => $email,
        'username' => $username
    ];
}
