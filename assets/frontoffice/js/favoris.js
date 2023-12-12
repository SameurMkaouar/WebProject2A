$(document).ready(function() {
    var favoris = [];

    // Ajout de l'écouteur pour gérer les clics sur l'icône du cœur
    $('body').on('click', '.favorite-icon', function(e) {
        e.stopPropagation();
        var eventId = $(this).data('event-id');
        var isFavorited = $(this).hasClass('favorited');

        if (isFavorited) {
            // Retirer l'événement du tableau des favoris
            var index = favoris.indexOf(eventId);
            if (index !== -1) {
                favoris.splice(index, 1);
            }
            // Retirer la classe 'favorited' pour changer l'apparence
            $(this).removeClass('favorited');
        } else {
            // Ajouter l'événement au tableau des favoris
            favoris.push(eventId);
            // Ajouter la classe 'favorited' pour changer l'apparence
            $(this).addClass('favorited');
        }

        // Mettre à jour l'affichage des favoris uniquement si le bouton "Mes Favoris" est activé
        if ($('#mes-favoris-btn').hasClass('active')) {
            updateFavoritesDisplay();
        }
    });

    // Event listener pour le bouton "Mes Favoris"
    $('#mes-favoris-btn').on('click', function() {
        // Activer ou désactiver le bouton "Mes Favoris"
        $(this).toggleClass('active');
        
        // Mettre à jour l'affichage des favoris lorsque le bouton est activé
        if ($(this).hasClass('active')) {
            updateFavoritesDisplay();
        } else {
            // Si le bouton est désactivé, afficher tous les événements
            $('.post').removeClass('hidden');
        }

        // Afficher ou masquer la section des favoris en fonction de l'état actuel
        $('#favorites-section').toggle($(this).hasClass('active'));
    });

    // Fonction pour mettre à jour l'affichage des favoris
    function updateFavoritesDisplay() {
        // Appliquer la classe 'hidden' uniquement aux événements qui ne sont pas des favoris
        $('.post').each(function() {
            var eventId = $(this).data('event-id');
            if (favoris.length > 0 && favoris.indexOf(eventId) === -1) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }
});
