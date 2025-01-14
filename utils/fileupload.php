<?php

class FileUpload {
    private static $dossierUpload = APP_ROOT . '/upload/';

    /**
     * Initialiser le dossier d'uploads si nécessaire.
     */
    public static function init(): void {
        try {
            if (!is_dir(self::$dossierUpload)) {
                mkdir(self::$dossierUpload, 0755, true);
            }
        } catch (Exception $e) {
            throw new Exception("erreur_creation_dossier");
        }
    }

    /**
     * Obtenir le répertoire spécifique pour un utilisateur.
     * 
     * @param int $idUtilisateur ID de l'utilisateur.
     * @return string Chemin du dossier utilisateur.
     */
    private static function getDossierUtilisateur(int $idUtilisateur): string {
        return self::$dossierUpload . $idUtilisateur . '/';
    }

    /**
     * Enregistrer la photo de profil pour un utilisateur.
     * 
     * @param Utilisateur $utilisateur Instance de l'utilisateur.
     * @param array $files Données du fichier (ex : $_FILES['photo']).
     * @return string|null Chemin du fichier enregistré, ou null si erreur.
     */
    public static function enregistrerPhotoProfil(Utilisateur $utilisateur, array $files): string {
        if (self::validerImage($files)) {
            $dossierUtilisateur = self::getDossierUtilisateur($utilisateur->getId());
            // Initialiser le dossier d'uploads de l'utilisateur si nécessaire.
            if (!is_dir($dossierUtilisateur)) {
                mkdir($dossierUtilisateur, 0755, true);
            }

            // Déplacer le fichier téléchargé dans le dossier d'uploads de l'utilisateur.
            $extensionFichier = pathinfo($files['name'], PATHINFO_EXTENSION);
            $nouveauNomFichier = "photo_profil." . $extensionFichier;
            $destination = $dossierUtilisateur . $nouveauNomFichier;

            if (move_uploaded_file($files['tmp_name'], $destination)) {
                return $destination;
            }
        }

        throw new Exception("echec_enregistrement");
    }

    /**
     * Valider le fichier téléchargé.
     * 
     * @param array $fichier Données du fichier (ex : $_FILES['photo']).
     * @return bool True si valide, False sinon.
     */
    private static function validerImage(array $files): bool {
        // On utilise le type MIME pour valider le fichier, les extensions étant facilement falsifiables.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($files['tmp_name']);
        $typesAutorises = ['image/jpeg', 'image/png'];

        $tailleMaximale = 5 * 1024 * 1024; // 5 Mo, taille arbitraire pour le moment.

        if ($files['error'] !== UPLOAD_ERR_OK) { // Upload sans erreur
            throw new Exception("erreur_upload");
            return false;
        }

        if (!in_array($mimeType, $typesAutorises)) { // Type de fichier autorisé
            throw new Exception("type_invalide");
            return false;
        }

        if ($files['size'] > $tailleMaximale) { // Ne dépasse pas la taille maximale
            throw new Exception("taille_depassee");
            return false;
        }

        return true;
    }
}
?>
