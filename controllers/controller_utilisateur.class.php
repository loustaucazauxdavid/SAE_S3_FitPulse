<?php
/**
 * @file controller_utilisateur.class.php
 * @brief Controller pour utilisateur
 */

require_once 'utils/session.php';
require_once 'utils/fileupload.php';

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
        verifierConnexionInterdite(); // Interdire l'accès si le visiteur de la page est déjà authentifié  
    
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
        verifierConnexionInterdite(); // Interdire l'accès si le visiteur de la page est déjà authentifié

        $msgErreurs = $this->handleConnexion(); // Gérer la tentative de connexion de l'utilisateur

        if (is_null($msgErreurs)) { 
            // Connexion réussie
            header('Location: index.php');
        } else {   
            // Connexion échouée, affichage à nouveau de la page de connexion avec les messages d'erreurs
            $template = $this->getTwig()->load('authentification.html.twig');    
            echo $template->render(array(
                'mode' => 'connexion', // Mode de la page à afficher : connexion (page affichée pour cette demande)
                'msgErreurs' => $msgErreurs
            ));            
        }
    }

    public function deconnexion() {
        verifierConnexionObligatoire(); // Interdire l'accès si le visiteur de la page n'est pas connecté

        // Déconnexion de l'utilisateur
        session_unset(); // Supprimer toutes les variables de session
        session_destroy(); // Détruire la session

        // Redirection vers la page d'accueil
        header('Location: index.php');
    }
    
    /**
     * @brief Affiche la page d'inscription et valide la tentative d'inscription
     * @return void
     */
    public function inscription() {
        verifierConnexionInterdite(); // Interdire l'accès si le visiteur de la page est déjà authentifié
        
        $msgErreurs = $this->handleInscription(); // Gérer la tentative d'inscription de l'utilisateur

        if (is_null($msgErreurs)) { 
            // Inscription réussie
            header('Location: index.php');
        } else {   
            // Inscription échouée, affichage à nouveau de la page de connexion avec les messages d'erreurs
            $template = $this->getTwig()->load('authentification.html.twig');    
            echo $template->render(array(
                'mode' => 'inscription', // Mode de la page à afficher : inscription (page affichée pour cette demande),
                'msgErreurs' => $msgErreurs
            ));            
        }
    }

    /**
     * @brief Affiche la page de mot de passe oublié et valide la demande de réinitialisation de mot de passe  
     * @return void
     */
    public function motdepasseoublie() {
        verifierConnexionInterdite(); // Interdire l'accès si le visiteur de la page est déjà authentifié
        
        echo "Fonction de mot de passe oublié pas encore implémentée.";
    }  

    private function handleConnexion(): ?array {
        // Récupération des données du formulaire
        $mail = parent::getPost()['mail'] ?? '';
        $motDePasse = parent::getPost()['motDePasse'] ?? '';
    
        $utilisateur = new Utilisateur($mail, $motDePasse);
    
        $msgErreurs = null; // Tableau des erreurs (nullable)
    
        try { 
            if ($utilisateur->authentification($this->getPdo())) {   

                verifierSessionActive();            
                session_regenerate_id(true); // Régénérer l'identifiant de session pour éviter les attaques de fixation de session

                // Connexion réussie
                $_SESSION['authentifie'] = true; 
                $_SESSION['utilisateur'] = [
                    'id' => $utilisateur->getId(),
                    'mail' => $utilisateur->getMail(),
                    'nom' => $utilisateur->getNom(),
                    'prenom' => $utilisateur->getPrenom(),
                    'photo' => $utilisateur->getPhoto(),
                    'estAdmin' => (int)$utilisateur->getEstAdmin()
                ];
            } else {  
                // Connexion échouée
                $_SESSION['authentifie'] = false; 
    
                $msgErreurs = ["Adresse mail et/ou mot de passe incorrect(s)."];
            }
        } catch (Exception $e) { 
            // Gestion des exceptions
            $msgErreurs = []; // Initialisation des erreurs
    
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
    
        // Retourne null si tout est OK, ou un tableau d'erreurs s'il y en a
        return $msgErreurs;  
    }

    private function handleInscription(): ?array {
        // Récupération des données du formulaire
        $mail = parent::getPost()['mail'] ?? '';
        $motDePasse = parent::getPost()['motDePasse'] ?? '';
        $nom = parent::getPost()['nom'] ?? '';
        $prenom = parent::getPost()['prenom'] ?? '';
    
        // Création d'une instance de la classe Utilisateur avec les données du formulaire
        $utilisateur = new Utilisateur($mail, $motDePasse);
        $utilisateur->setNom($nom);
        $utilisateur->setPrenom($prenom);
    
        $msgErreurs = null; // Tableau des erreurs (nullable)
    
        try {
            // Tentative d'inscription
            $utilisateur->inscription($this->getPdo());

            // Ajouter la photo de profil si elle a été fournie
            if (isset(parent::getFiles()['photo']) && parent::getFiles()['photo']['error'] != 4) { // Erreur 4 : Aucun fichier n'a été envoyé par le formulaire
                // Traiter l'upload de la photo de profil
                FileUpload::init();
                $lienPhoto = FileUpload::enregistrerPhotoProfil($utilisateur, parent::getFiles()['photo']);
    
                // Mettre à jour le lien de la photo de profil de l'utilisateur 
                $utilisateur->setPhoto($lienPhoto);
                $managerUtilisateur = new UtilisateurDao($this->getPdo());
                $managerUtilisateur->updatePhoto($utilisateur);   
            }
        } 
        catch (Exception $e) {
            // Initialisation du tableau des erreurs
            $msgErreurs = [];
    
            // Gestion des exceptions
            switch ($e->getMessage()) {
                // Exceptions inscription
                case "compte_existant":
                    $msgErreurs[] = "Ce compte existe déjà.";
                    break;
    
                case "mdp_faible":
                    $msgErreurs[] = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
                    break;
    
                // Exceptions upload photo
                case "erreur_upload":
                    $msgErreurs[] = "Échec de l'enregistrement de la photo de profil.";
                    break;
    
                case "extension_invalide":
                    $msgErreurs[] = "Le fichier n'est pas une image au format JPG, JPEG ou PNG.";
                    break;
    
                case "taille_depassee":
                    $msgErreurs[] = "Le fichier est trop volumineux.";
                    break;
    
                // Default
                default:
                    $msgErreurs[] = "Erreur interne, veuillez réessayez plus tard.";
                    break;
            }
        }
    
        // Retourne null si tout est OK, ou un tableau d'erreurs s'il y en a
        return $msgErreurs;  
    }    
}
?>
