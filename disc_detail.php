<?php
    require "db.php";
    $db = connexionBase();

    
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

   
    $requete = $db->prepare("SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id WHERE disc.disc_id = ?");
    
    $requete->execute(array($id));
    
    
    $myDisc = $requete->fetch(PDO::FETCH_OBJ);
   
    
    $requete->closeCursor();
    } else {
        echo "L'identifiant du disque est manquant.";
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <title>Détails</title>
    </head>
    <body>
        
        <div><h1><b>Disque </b>N°<?= $myDisc->disc_id ?></h1><br><br></div>
    <div class="container-fluid">
        <div class="row ">
        <div class="col-6">
        <b>Titre : </b><br>
        <div class="bg-light rounded"><?= $myDisc->disc_title ?></div>
        </div>
        <div class="col-6">
        <b>Nom de l'artiste : </b><br>
        <div class="bg-light rounded"><?= $myDisc->artist_name ?></div>
        </div></div>

        <div class="row">
        <div class="col-6">
        <b>Date de sortie : </b><br>
        <div class="bg-light rounded"><?= $myDisc->disc_year ?></div>
        </div>
        <div class="col-6">
        <b> Genre : </b><br>
        <div class="bg-light rounded"><?= $myDisc->disc_genre ?></div>
        </div></div>
        
        <div class="row">
        <div class="col-6">
        <b>Label : </b><br>
        <div class="bg-light rounded"><?= $myDisc->disc_label ?></div>
        </div>
        <div class="col-6">
        <b> Prix </b><br>
        <div class="bg-light rounded"><?= $myDisc->disc_price ?>€</div>
        </div></div>
        
       
        
        </div>
        </div>
        <div><img src="jaquettes/<?= $myDisc->disc_picture ?>" width="450px" height="450px" alt="Jaquette"></div>
        <div><br>
        <a class="btn btn-primary" href="disc_modif.php?id=<?= $myDisc->disc_id ?>">Modifier</a>
        <a class="btn btn-primary" onclick="return confirm('Voulez-vous vraiment supprimer ce disque ?')" href="script_disc_delete.php?id=<?= $myDisc->disc_id ?>">Supprimer</a>
        <a class="btn btn-primary" href="disc.php">Retour</a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>