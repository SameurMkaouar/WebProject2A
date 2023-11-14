<?php
require('../Controller/joueurC.php');

$joueurController = new joueurC();
$joueurs = $joueurController->listJoueurs();

echo '<table>';
echo '<tr>';
echo '<th>ID Joueur</th>';
echo '<th>Nom</th>';
echo '<th>Prénom</th>';
echo '<th>Email</th>';
echo '<th>Téléphone</th>';
echo '<th>Actions</th>';
echo '</tr>';

foreach ($joueurs as $joueur) {
    echo '<tr>';
    echo '<td>' . $joueur['idJoueur'] . '</td>';
    echo '<td>' . $joueur['nom'] . '</td>';
    echo '<td>' . $joueur['prenom'] . '</td>';
    echo '<td>' . $joueur['email'] . '</td>';
    echo '<td>' . $joueur['tel'] . '</td>';
    
    // Ajout du lien "delete" avec l'ID du joueur en tant que paramètre
    echo '<td><a href="?delete=' . $joueur['idJoueur'] . '">delete</a></td>';
    // Ajout du lien "update" avec l'ID du joueur en tant que paramètre
    echo '<td><a href="updateJoueur.php?id=' . $joueur['idJoueur'] . '">update</a></td>';
    
    echo '</tr>';
}

// Ajout du lien "add" pour ajouter un nouveau joueur
echo '<tr>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td><a href="AddJoueur.php">add</a></td>';
echo '</tr>';

echo '</table>';

if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    if ($joueurController->deleteJoueur($idToDelete)) {
        echo 'Joueur supprimé avec succès.';
    } else {
        echo 'Erreur lors de la suppression du joueur.';
    }
}
?>
