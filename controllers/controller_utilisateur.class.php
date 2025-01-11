<?php
/**
 * @file controller_utilisateur.class.php
 * @brief Controller pour utilisateur
 */

require_once 'utils/session.php';

/**
 * @brief Controller pour utilisateur
 * @details Gère les actions liées à utilisateur
 */
class ControllerUtilisateur extends Controller {
    /**
     * Constructeur de la classe ControllerUtilisateur
     * @param \Twig\Environment $twig
     * @param \Twig\Loader\FilesystemLoader $loader
     * @return void
     */
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }

    /**
     * @brief Affiche la page d'authentification utilisateur correspondante de la demande du visiteur de la page (connexion ou inscription)
     * @return void
     */
    public function afficher() {
        verifierConnexionInterdite(); // Interdire l'accès si l'utilisateur est déjà authentifié  
    
        // Récuperer la demande d'affichage du visiteur de la page. Si non spécifiée, définir par défaut à 'connexion'
        $demande = (isset(parent::getGet()['demande'])) ? parent::getGet()['demande'] : 'connexion'; 

        // Si la demande n'est pas valide (ni connexion ni inscription), on définit par défaut à 'connexion'
        if ($demande != 'connexion' && $demande != 'inscription') {
            $demande = 'connexion';
        }
        
        $template = $this->getTwig()->load('authentification.html.twig');    
        echo $template->render(array(
            'mode' => $demande, // Mode de la page à afficher (inscription ou connexion)
        ));
    }

    /**
     * @brief Affiche la page de connexion et valide la tentative de connexion
     * @return void
     */
    public function connexion() {
        verifierConnexionInterdite(); // Interdire l'accès si l'utilisateur est déjà authentifié

        $loginInfo = $this->handleConnexion(); // Gérer la tentative de connexion de l'utilisateur

        if ($loginInfo['success']) { 
            // Connexion réussie
            echo "Connexion réussie.";
        } else {   
            // Connexion échouée, affichage à nouveau de la page de connexion avec les messages d'erreurs
            $template = $this->getTwig()->load('authentification.html.twig');    
            echo $template->render(array(
                'mode' => 'connexion', // Mode de la page à afficher : connexion,
                'msgErreurs' => $loginInfo['msgErreurs']
            ));            
        }
    }
    
    /**
     * @brief Affiche la page d'inscription et valide la tentative d'inscription
     * @return void
     */
    public function inscription() {
        verifierConnexionInterdite(); // Interdire l'accès si l'utilisateur est déjà authentifié
    
        echo "Fonction d'inscription pas encore implémentée.";       
    }

    /**
     * @brief Affiche la page de mot de passe oublié et valide la demande de réinitialisation de mot de passe  
     * @return void
     */
    public function motdepasseoublie() {
        verifierConnexionInterdite(); // Interdire l'accès si l'utilisateur est déjà authentifié
        
        echo "Fonction de mot de passe oublié pas encore implémentée.";
    }  

    private function handleConnexion(): array {
        $mail = parent::getPost()['mail'] ?? '';
        $motDePasse = parent::getPost()['motDePasse'] ?? '';

        $utilisateur = new Utilisateur($mail, $motDePasse);

        $msgErreurs = []; // messages d'erreurs à afficher à l'utilisateur s'il y en a 

        $aReussi = false; // Variable pour indiquer si la connexion a réussi
        
        try {
            if ($utilisateur->authentification($this->getPdo())) {   
                // Connexion réussie
                $_SESSION['authentifie'] = true; 
                $_SESSION['utilisateur'] = [
                    'id' => $utilisateur->getId(),
                    'mail' => $utilisateur->getMail(),
                    'nom' => $utilisateur->getNom(),
                    'prenom' => $utilisateur->getPrenom(),
                    'photo' => $utilisateur->getPhoto(),
                    'dateInscription' => $utilisateur->getDateInscription()?->format('Y-m-d H:i:s'),
                    'statutCompte' => $utilisateur->getStatutCompte(),
                    'estAdmin' => (int)$utilisateur->getEstAdmin(),
                    'tentativesEchoueesConn' => $utilisateur->getTentativesEchoueesConn(),
                    'dateDernierEchecConn' => $utilisateur->getDateDernierEchecConn()?->format('Y-m-d H:i:s'),
                    'tokenReinitialisation' => $utilisateur->getTokenReinitialisation(),
                    'expirationToken' => $utilisateur->getExpirationToken()?->format('Y-m-d H:i:s')
                ];

                $aReussi = true;
            } else {  
                // Connexion échouée
                $_SESSION['authentifie'] = false; 

                $msgErreurs[] = "Adresse mail et/ou mot de passe incorrect(s).";
            }
        } catch (Exception $e) { 
            // Gestion des exceptions

            switch ($e->getMessage()) {
                case "compte_desactive":
                    // Calcul du temps restant avant réactivation du compte
                    $tempsRestant = $utilisateur->tempsRestantAvantReactivationCompte();
                    $minutes = floor($tempsRestant / 60);
                    $secondes = $tempsRestant % 60;

                    // Message informant l'utilisateur que son compte est temporairement bloqué
                    $msgErreurs[] = "Votre compte est temporairement désactivé en raison de plusieurs tentatives échouées.
                    Veuillez réessayer dans " . $minutes . " minutes et " . $secondes . " secondes.";
                    break;

                default:
                    $msgErreurs[] = "Erreur inconnue, veuillez réessayez plus tard.";
                    break;
            }
        }

        // Retourne un tableau contenant le succès de la connexion et les messages d'erreursa
        return ['success' => $aReussi, 'msgErreurs' => $msgErreurs];
    }
}
?>
