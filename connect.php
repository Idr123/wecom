<?php
// Assurez-vous que la session est démarrée
session_start();

// Récupérer les ID des produits depuis la session
$product_ids_array = array();

foreach ($_SESSION as $name => $value) {
    if ($value > 0 && substr($name, 0, 8) == "product_") {
        $length = strlen($name);
        $id = substr($name, 8, $length);
        $product_ids_array[] = $id;
    }
}

// Convertir le tableau d'ID en une chaîne séparée par des virgules
$product_ids = implode(',', $product_ids_array);

// Autres informations du formulaire
$name = $_POST['name'];
$address = $_POST['address'];
$number = $_POST['number'];
$methods = $_POST['methods'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'wecom');
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO orders (name, address, number, methods, product_ids) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $name, $address, $number, $methods, $product_ids);
    $execval = $stmt->execute();

    if ($execval) {
        echo "Registration successfully...";

        // Redirection vers une autre page après l'enregistrement
        header("Location:../public/success.php");
        exit(); // Assurez-vous de terminer l'exécution du script après la redirection
    } else {
        echo "Registration failed.";
    }

    $stmt->close();
    $conn->close();
}
?>
