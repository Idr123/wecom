<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-A6dFf4rAhiM5J2H5NnFjnGt1zVS0XRoVaa8eIS4e/Jr59x6Yng6S5ivIiUg2JeaN" crossorigin="anonymous">

<div class="container mt-5">
    <h2>Tableau des Enregistrements</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Number</th>
                <th>Methods</th>
                <th>product_ids</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', '', 'wecom');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Requête SQL pour sélectionner tous les enregistrements de la table "registration"
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);

            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                // Afficher les données de chaque ligne dans une boucle
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["number"] . "</td>";
                    echo "<td>" . $row["methods"] . "</td>";
                    echo "<td>" . $row["product_ids"] . "</td>";
                    echo "<td><button class='btn btn-danger' onclick='deleteRecord(" . $row["id"] . ")'><i class='fa fa-times'></i></button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun enregistrement trouvé dans la table.</td></tr>";
            }

            // Fermer la connexion à la base de données
            $conn->close();
            ?>

        </tbody>
    </table>
</div>

<script>
    function deleteRecord(recordId) {
        var confirmation = confirm("Voulez-vous vraiment supprimer cet enregistrement ?");
        if (confirmation) {
            $.ajax({
                type: "POST",
                url: "../../resources/delete.php", // Remplacez par le chemin du script de suppression sur votre serveur
                data: { id: recordId },
                success: function(response) {
                    alert(response); // Affichez la réponse du serveur
                    // Vous pouvez également actualiser la page ou effectuer d'autres actions nécessaires
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }
</script>

