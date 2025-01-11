<?php
/**
 * Convertit une chaîne de date en objet DateTime.
 * 
 * @param string|null $dateString La chaîne de date à convertir.
 * @return DateTime|null L'objet DateTime si la chaîne est valide, null sinon.
 */
function strToDateTime(?string $dateString): ?DateTime {
    if ($dateString && strtotime($dateString) !== false) {
        return new DateTime($dateString);
    }
    return null;
}
?>