<?php    
require "db.php";
    $db = connexionBase();
    $requete = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc.disc_id=?");
    $requete->execute(array($_GET["id"]));
    $myDisc = $requete->fetch(PDO::FETCH_OBJ);
    $requete->closeCursor();

    $requete2 = $db->prepare("SELECT * FROM artist");
    $requete2->execute();
    $myArtist = $requete2->fetchAll(PDO::FETCH_OBJ);
    $requete2->closeCursor();
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Modification</title>
</head>
<body>

    <h1>Modification du Disque n°<?= $myDisc->disc_id; ?></h1>

    <br>
    <br>


    <form action ="test.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="disc_id" value="<?= $myDisc->disc_id ?>">

        <div class="row justify-content-between">
        <div class="col-md-6">
        <div class="bg-light rounded">
        <label for="titre">Nom de l'album : </label><br>
        <input type="text" name="titre" id="titre" value="<?= $myDisc->disc_title ?>">
        <br><br></div>

        <div class="bg-light rounded">
        <label for="select_artist">Selectionner un artiste : </label><br>
        <select name="select_artist" id="select_artist">
        <?php foreach($myArtist as $artist): ?>
        <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
        <?php endforeach; ?>
        </select>
        <br><br></div>

        <div class="bg-light rounded">
        <label for="annee">Date de sortie : </label><br>
        <input type="text" name="annee" id="annee" value="<?= $myDisc->disc_year ?>">
        <br><br></div>

        <div class="bg-light rounded">
        <label for="genre">Genre : </label><br>
        <input type="text" name="genre" id="genre" value="<?= $myDisc->disc_genre ?>">
        <br><br></div>

        <div class="bg-light rounded">
        <label for="label">Label : </label><br>
        <input type="label" name="label" id="label" value="<?= $myDisc->disc_label ?>">
        <br><br></div>

        <div class="bg-light rounded">
        <label for="prix">Prix : </label><br>
        <input type="prix" name="prix" id="prix" value="<?= $myDisc->disc_price ?>">
        <br><br></div>
        </div>

        <!--<label for="url_for_label">Adresse site internet :</label><br>
        <input type="text" name="url" id="url_for_label" value="<?= $myDisc->artist_url ?>">
        <br><br>-->

        <div class="col-md-6">
        <label class="bg-light rounded" for="jaquette">Choisir une autre jaquette :</label><br><br>
        <input class="bg-light rounded" type="file" name="jaquette" id="jaquette">
        <br><br>

        

        <img src="jaquettes/<?= $myDisc->disc_picture ?>" width="300px" height="300px" alt="jaquette">
        <br><br>
        </div>
        </div>

        <!--<input type="reset" value="Annuler">-->
        <input class="btn btn-primary" type="submit" value="Modifier" onclick="return confirm('Voulez-vous vraiment modifier ce disque ?')">
        <a class="btn btn-primary" href="disc.php">Retour à la liste des disques</a>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>