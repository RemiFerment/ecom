<?php
class JWT
{
    public function generate(array $header, array $payload, string $secret, int $validity = 86400): string
    {
        if ($validity > 0) {
            $now = new DateTime();
            $payload['iat'] = $now->getTimestamp();  // Date de création
            $payload['exp'] = $now->getTimestamp() + $validity;  // Expiration
        }

        // Encodage en base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        // Nettoyage des caractères (+, /, =) pour éviter les problèmes dans les URL
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        // Génération de la signature
        $secret = base64_encode($secret);
        $signature = hash_hmac('sha256', "$base64Header.$base64Payload", $secret, true);
        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Assemblage du JWT
        return "$base64Header.$base64Payload.$base64Signature";
    }

    // Autres méthodes pour vérifier et récupérer les informations du JWT...
}
