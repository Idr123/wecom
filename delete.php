<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'wecom');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID est passé en tant que paramètre
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'enregistrement avec l'ID donné
    $sql = "DELETE FROM orders WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Enregistrement supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'enregistrement: " . $conn->error;
    }
} else {
    echo "ID non spécifié pour la suppression.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
