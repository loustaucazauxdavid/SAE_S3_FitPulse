<?php

class Cleaner
{
    /**
     * Nettoyer et sanitiser une adresse email.
     * Permet d'éviter les failles XSS via ce biais.
     *
     * @param string $email L'adresse email à nettoyer.
     * @return string L'adresse email nettoyée et sanitiser.
     */
    public static function nettoyerEmail(string $email): string
    {
        // Supprimer les espaces en début et fin de chaîne
        $email = trim($email);

        // Sanitiser l'email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Échapper les caractères spéciaux, peut être redondant avec la sanitisation, sécurité supplémentaire
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        return $email;
    }

    public static function nettoyerChaine(string $chaine): string
    {
        // Supprimer les espaces en début et fin de chaîne
        $chaine = trim($chaine);

        // FILTER_SANITIZE_STRING est déprécié

        // Sanitiser la chaîne
        $chaine = htmlspecialchars($chaine, ENT_QUOTES, 'UTF-8');

        return $chaine;
    }

    public static function nettoyerEntier(string $entier): int
    {
        // Supprimer les espaces en début et fin de chaîne
        $entier = trim($entier);

        // Sanitiser l'entier
        $entier = filter_var($entier, FILTER_SANITIZE_NUMBER_INT);

        // Échapper les caractères spéciaux, peut être redondant avec la sanitisation, sécurité supplémentaire
        $entier = htmlspecialchars($entier, ENT_QUOTES, 'UTF-8');

        return $entier;
    }
}

?>