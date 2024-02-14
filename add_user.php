<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users App</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 50px;
        }

        .rwrapper {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    
    <div class="container">
        <div class="rwrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
                <h2>Ajouter une tâche</h2>
                <div><a href="index2.php">Retour vers la premiere page </a></div>
            </div>
            
            <form action="traitement.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input name="Titre" type="text" class="form-control" placeholder="titre" autocomplete="false">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="descr" class="form-control" rows="3" autocomplete="false"></textarea>
    </div>
    <!-- Ajout du champ pour le téléchargement de la photo -->
    <div class="mb-3">
        <label class="form-label">Photo</label>
        <input type="file" name="photo" accept="image/*" class="form-control">
    </div>

    <input type="submit" class="btn btn-primary" value="Save" name="save">
</form>

        </div>
    </div>
</body>

</html>