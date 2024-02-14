<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
    <style>
        .thumbnail {
    width: 100px; 
    height: 100px; 
}

body {
    background-image: url('cars.jpg');
    background-position: center;;
    background-size: cover;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}


.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.7); /* Couleur de fond semi-transparente */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}
        
  
       
       
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.7); /* Couleur de fond semi-transparente */
          
        }

 

th, td {
    border: 1px solid rgba(0, 0, 0, 0.2); /* Bordure semi-transparente */
    text-align: left;
    padding: 40px;
}

th {
    background-color: grey  ; /* Couleur d'en-tête semi-transparente */
    color: #fff;
}

tr:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.5); /* Couleur de ligne semi-transparente */
}

tr:hover {
    background-color: rgba(224, 224, 224, 0.5); /* Couleur de survol semi-transparente */
}
    </style>
    <title>Your Page Title</title>

   
   
<body>






<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Titre"], $_POST["descr"], $_FILES["photo"])) {
    $Titre = $_POST["Titre"];
    $descr = $_POST["descr"];
    $photo = $_FILES["photo"]["name"];

    // Check if a file is uploaded
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $photo)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO pic (Titre, descr, photo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $Titre, $descr, $photo);

        if ($stmt->execute()) {
            echo "Nouvel utilisateur ajouté avec succès";
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur lors du téléchargement du fichier photo.";
    }
}

// Display existing data in a table
$sql = "SELECT id, Titre, descr, photo FROM pic";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Titre</th><th>Description</th><th>Photo</th><th>Action</th></tr>";

    while ($rows = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rows["Titre"] . "</td>";
        echo "<td>" . $rows["descr"] . "</td>";
        
        echo "<td><img src='" .htmlspecialchars( $rows['photo']) . "' alt='Photo' class='thumbnail'></td>";


        echo "<td>
              <form method='post' action=''>
                  <input type='hidden' name='delete_id' value='" . $rows["id"] . "'>
                  <button type='submit'>Supprimer</button>
                  <input type='hidden' name='update_id' id='update' value='" . $rows["id"] . "'>
                  <button type='submit'>update</button>
              </form>
             
            </td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "";
}

// Check if the delete form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];

    // Use prepared statement to prevent SQL injection
    $stmt_delete = $conn->prepare("DELETE FROM pic WHERE id = ?");
    $stmt_delete->bind_param("i", $delete_id);

    if ($stmt_delete->execute()) {
        echo "Supprimée avec succès";
    } else {
        echo "Erreur lors de la suppression de l'entrée : " . $stmt_delete->error;
    }

    $stmt_delete->close();
}





if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_id"], $_POST["nouveau_nom"])) {
    $update_id = $_POST["update_id"];
    $nouveau_nom = $_POST["nouveau_nom"];

    // Utilisez une instruction préparée pour éviter les injections SQL
    $stmt_update = $conn->prepare("UPDATE pic SET photo = ? WHERE id = ?");
    $stmt_update->bind_param("si", $nouveau_nom, $update_id);

    if ($stmt_update->execute()) {
        echo "Nom de la photo mis à jour avec succès";
    } else {
        echo "Erreur lors de la mise à jour du nom de la photo : " . $stmt_update->error;
    }

    $stmt_update->close();
}

$conn->close();
?>




</body>
</html>