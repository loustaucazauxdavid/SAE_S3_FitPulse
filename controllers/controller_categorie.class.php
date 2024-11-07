<?php 

class ControllerCategorie extends Controller{
    public function __construct(\Twig\Environment $twig, \Twig\Loader\FilesystemLoader $loader) {
        parent::__construct($twig, $loader);
    }

    public function afficher(){
        $id_categorie = isset($_GET['id_categorie'])?$_GET['id_categorie']:null;

 

        //Récupération de la catégorie
        $managerCategorie = new CategorieDao($this->getPdo());
        $categorie = $managerCategorie->find($id_categorie);


        $template = $this->getTwig()->load('categorie.html.twig');
        echo $template->render(array(
                'categorie' => $categorie,
            ));
    }

    public function lister(){
        //recupération des catégories
        $managerCategorie = new CategorieDao($this->getPdo());
        $tableau = $managerCategorie->findAllAssoc();
        $categories = $managerCategorie->hydrateAll($tableau);

        //Choix du template
        $template = $this->getTwig()->load('index.html.twig');


        //Affichage de la page
        echo $template->render(array(
            'categories' => $categories,
            'menu' => 'categories',
            // 'description' => "Le site des recettes de cuisine de l'IUT de Bayonne"
        ));
    }

    public function listerTableau(){
        $managerCategorie = new CategorieDao($this->getPdo());
        $categories = $managerCategorie->findAll();


        //Génération de la vue
        $template = $this->getTwig()->load('categories_tableau.html.twig');
        echo $template->render(array(
                'categories' => $categories,
                'menu' => 'categories_tableau'
            ));
    }
}