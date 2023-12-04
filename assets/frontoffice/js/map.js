// Fonction pour afficher la carte dans une nouvelle fenêtre ou nouvel onglet
function showMapInNewWindow(address) {
    // Encodage de l'adresse pour l'URL
    var encodedAddress = encodeURIComponent(address);

    // URL de la carte Google Maps avec l'adresse encodée
    var mapURL = 'https://www.google.com/maps?q=' + encodedAddress;

    // Ouvrir une nouvelle fenêtre ou nouvel onglet
    window.open(mapURL, '_blank');
}

// Code JavaScript pour détecter le clic sur l'icône de la carte
document.addEventListener("DOMContentLoaded", function () {
    // Cibler tous les éléments avec la classe "map-marker"
    var mapMarkers = document.querySelectorAll('.map-marker');

    // Ajouter un gestionnaire d'événements à chaque icône de la carte
    mapMarkers.forEach(function (marker) {
        marker.addEventListener('click', function () {
            // Obtenir l'adresse à partir de l'attribut "data-location"
            var address = marker.getAttribute('data-location');

            // Appeler la fonction pour afficher la carte dans une nouvelle fenêtre ou nouvel onglet
            showMapInNewWindow(address);
        });
    });
});