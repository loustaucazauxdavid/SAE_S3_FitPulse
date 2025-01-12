<?php
// Vérification et gestion de session centralisée dans index.php
// Aucune gestion de démarrage de session ici

/**
 * Vérifie si l'utilisateur est connecté.
 * 
 * @return bool
 */
function estConnecte(): bool {
    verifierSessionActive();
    return isset($_SESSION['authentifie']) && $_SESSION['authentifie'] === true;
}

/**
 * Vérifie que l'utilisateur est connecté.
 * Redirige vers la page donnée si l'utilisateur n'est pas connecté.
 * 
 * @param string $redirection L'URL de redirection si non connecté (par défaut : page d'accueil).
 */
function verifierConnexionObligatoire(string $redirection = 'index.php'): void {
    if (!estConnecte()) {
        header("Location: $redirection");
        exit();
    }
}

/**
 * Vérifie que l'utilisateur n'est pas connecté.
 * Redirige vers la page donnée si l'utilisateur est connecté.
 * 
 * @param string $redirection L'URL de redirection si connecté (par défaut : page d'accueil).
 */
function verifierConnexionInterdite(string $redirection = 'index.php'): void {
    if (estConnecte()) {
        header("Location: $redirection");
        exit();
    }
}

/**
 * Vérifie si la session est active. Si non, démarre une session.
 */
function verifierSessionActive(): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}
?>
