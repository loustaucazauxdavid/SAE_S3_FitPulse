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
     * @brief Affiche la page de connexion et valide la tentative de connexion de l'utilisateur essayant de se connecter
     * @return void
     */
    public function connexion() {
        echo "Fonction de connexion pas encore implémentée.";     
    }

    /**
     * @brief Affiche la page d'inscription et valide la tentative de connexion de l'utilisateur essayant de se connecter
     * @return void
     */
    public function inscription() {
        echo "Fonction d'inscription pas encore implémentée.";       
    }
}

?>