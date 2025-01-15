tarteaucitron.init({
    "privacyUrl": "", // URL vers la politique de confidentialité
    "bodyPosition": "bottom", // Position du bandeau (bottom ou top)

    "hashtag": "#tarteaucitron", // Hashtag pour ouvrir le panneau via l'URL
    "cookieName": "tarteaucitron", // Nom du cookie de consentement

    "orientation": "middle", // Position du bandeau (top, bottom ou middle)

    "groupServices": false, // Grouper les services par catégorie (true/false)
    "showDetailsOnClick": true, // Afficher les détails des services au clic
    "serviceDefaultState": "wait", // État par défaut des services (true, wait, false)

    "showAlertSmall": false, // Afficher une petite bannière en bas à droite
    "cookieslist": false, // Afficher la liste des cookies sur le panneau

    "closePopup": false, // Afficher une croix pour fermer le bandeau

    "showIcon": true, // Afficher une icône flottante pour gérer les cookies
    //"iconSrc": "", // URL ou base64 pour une icône personnalisée
    "iconPosition": "BottomRight", // Position de l'icône (BottomRight, BottomLeft, TopRight, TopLeft)

    "adblocker": false, // Afficher une alerte si un adblock est détecté

    "DenyAllCta": true, // Afficher le bouton "Tout refuser"
    "AcceptAllCta": true, // Afficher le bouton "Tout accepter"
    "highPrivacy": true, // Mode haute confidentialité (désactive l'auto-consentement)
    "alwaysNeedConsent": false, // Demander le consentement pour tous les services

    "handleBrowserDNTRequest": false, // Respecter le Do Not Track du navigateur (1 = désactiver tous les services)

    "removeCredit": false, // Retirer le lien de crédit (Powered by Tarteaucitron)
    "moreInfoLink": true, // Afficher un lien "En savoir plus"

    "useExternalCss": false, // Si false, le fichier tarteaucitron.css sera chargé par défaut
    "useExternalJs": false, // Si false, le fichier tarteaucitron.js sera chargé par défaut

    //"cookieDomain": ".my-multisite-domaine.fr", // Partage des cookies entre plusieurs sites
    "readmoreLink": "", // Lien personnalisé pour en savoir plus (facultatif)

    "mandatory": true, // Afficher un message sur les cookies obligatoires
    "mandatoryCta": true, // Afficher le bouton d'acceptation des cookies obligatoires quand activé

    //"customCloserId": "", // ID personnalisé pour un élément qui ouvre le panneau
    "googleConsentMode": true, // Activer le mode de consentement Google v2 pour Google Ads et GA4

    "partnersList": false // Afficher le nombre de partenaires dans le pop-up ou le bandeau central
});