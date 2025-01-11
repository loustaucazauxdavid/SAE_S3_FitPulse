<?php
/**
 * @file controller_utilisateur.class.php
 * @brief Controller pour utilisateur
 */

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

    /*  
     * @brief Affiche la page d'authentification utilisateur correspondante de la demande du visiteur de la page (connexion ou inscription)
     * @return void
     */
    public function afficher() {
        // Récuperer la demande d'affichage du visiteur de la page. Si non spécifiée, définir par défaut à 'connexion'
        $demande = (isset(parent::getGet()['demande'])) ? parent::getGet()['demande'] : 'connexion'; 

        // Si la demande n'est pas valide (ni connexion ni inscription), on définit par défaut à 'connexion'
        if ($demande != 'connexion' && $demande != 'inscription') {
            $demande = 'connexion';
        }
        
        $template = $this->getTwig()->load('authentification.html.twig');    
        echo $template->render(array(
            'mode' => $demande, // Mode de la page à afficher (inscription ou connexion)
            'estConnecte' => false // TODO : Implémenter système de connexion et passer la variable dans les controlleurs
        ));
    }

    /**
     * @brief Affiche la page de connexion et valide la tentative de connexion
     * @return void
     */
    public function connexion() {
        $loginInfo = $this->handleConnexion(); // Gérer la tentative de connexion de l'utilisateur

        if ($loginInfo['success']) { 
            // Connexion réussie
            echo "Connexion réussie.";
        } else {   
            // Connexion échouée, affichage à nouveau de la page de connexion avec les messages d'erreurs
            $template = $this->getTwig()->load('authentification.html.twig');    
            echo $template->render(array(
                'mode' => 'connexion', // Mode de la page à afficher : connexion
                'estConnecte' => false, // TODO : Implémenter système de connexion et passer la variable dans les controlleurs
                'msgErreurs' => $loginInfo['msgErreurs']
            ));            
        }
    }
    
    /**
     * @brief Affiche la page d'inscription et valide la tentative d'inscription
     * @return void
     */
    public function inscription() {
        echo "Fonction d'inscription pas encore implémentée.";       
    }

     /**
     * @brief Affiche la page de mot de passe oublié et valide la demande de réinitialisation de mot de passe  
     * @return void
     */
    public function motdepasseoublie() {
        echo "Fonction de mot de passe oublié pas encore implémentée.";
    }  

    private function handleConnexion() 
    {
        $mail = parent::getPost()['mail'] ?? '';
        $motDePasse = parent::getPost()['motDePasse'] ?? '';

        $utilisateur = new Utilisateur($mail, $motDePasse);

        $msgErreurs = []; // messages d'erreurs à afficher à l'utilisateur s'il y en a 
        
        try
        {
            if ($utilisateur->authentification($this->getPdo()))
            {   // Connexion réussie
                $_SESSION['authentifie'] = true; 
                $_SESSION['utilisateur'] = [
                    'id' => $utilisateur->getId(),
                    'mail' => $utilisateur->getMail(),
                    'motDePasse' => $utilisateur->getMotDePasse(),
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
                return ['success' => true, 'msgErreurs' => $msgErreurs];
            }
            else 
            {   // Connexion échouée
                $_SESSION['authentifie'] = false; 

                $msgErreurs[] = "Adresse mail et/ou mot de passe incorrect(s).";

                return ['success' => false, 'msgErreurs' => $msgErreurs];
            }
        }
        catch (Exception $e) // Gestion des exceptions
        {
            if ($e->getMessage() === "compte_desactive") // Ex : Compte désactivé
            {
                // Calcul du temps restant avant réactivation du compte
                $tempsRestant = $utilisateur->tempsRestantAvantReactivationCompte();
                $minutes = floor($tempsRestant / 60);
                $secondes = $tempsRestant % 60;

                // Message informant l'utilisateur que son compte est temporairement bloqué
                $msgErreurs[] = "Votre compte est temporairement désactivé en raison de plusieurs tentatives échouées.
                    Veuillez réessayer dans " . $minutes . " minutes et " . $secondes . " secondes.";
            }
            else
            {
                // Autres exceptions
                $msgErreurs[] = "Erreur inconnue, veuillez réessayez plus tard.";
            }
            
            return ['success' => false, 'msgErreurs' => $msgErreurs];
        }
    }
}

?>