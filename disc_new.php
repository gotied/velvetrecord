<?php
include "db.php";
    
$db = connexionBase();
$requete = $db->query("SELECT artist_name, artist_id FROM artist");

$myArtist = $requete->fetchAll(PDO::FETCH_OBJ);

$requete->closeCursor();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Le formulaire d'ajout</title>
</head>
<body>
    <div><h1><b>Ajouter un disque</b></h1></div>
    <br><br>
    <div>
    <div class="d-flex">
    <form action ="script_disc_ajout.php" method="post" enctype="multipart/form-data">
        
        <div class="bg-light rounded">
        <label for="select_artist">Selectionner un artiste : </label><br>
        <select name="select_artist" id="select_artist">
        <?php foreach($myArtist as $artist): ?>
        <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
        <?php endforeach; ?>
        </select>
        <br><br>
        </div>

        <div class="bg-light rounded">
        <div class="form-group">
        <div class="row"> 
        <div class="col-md-6">     
        <label for="titre">Titre de l'album :</label><br>
        <input type="text" name="titre" id="titre">
        <br><br>
        </div>
        
        <div class="col-md-6">
        <label for="annee">Année :</label><br>
        <input type="text" name="annee" id="annee">
        <br><br>
        </div>
        </div>
        </div>
        

        
        <div class="form-group">
        <div class="row">
        <div class="col-md-6">    
        <label for="genre">Genre :</label><br>
        <input type="text" name="genre" id="genre">
        <br><br>
        </div>

        <div class="col-md-6"> 
        <label for="label">Label :</label><br>
        <input type="text" name="label" id="label">
        <br><br>
        </div>
        </div>
        </div>
        </div>

        <div class="bg-light rounded">
        <label for="prix">Prix :</label><br>
        <input type="text" name="prix" id="prix">
        <br><br>
        </div>

        <div class="bg-light rounded"><label for="jaquette">Choisir une jaquette :</label><br><br>
        <input type="file" name="jaquette" id="jaquette">
        <br><br></div>
        

        <input class="btn btn-primary" type="submit" value="Ajouter">
        
        <a class="btn btn-primary" href="disc.php">Retour</a>

    </form>
    </div>
    </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>