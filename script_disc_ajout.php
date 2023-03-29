<?php
    if (isset($_POST['select_artist']) && $_POST['select_artist'] != "") {
       $select = $_POST['select_artist'];
    }
    else {
        $select = Null;
    }
    if (isset($_POST['titre']) && $_POST['titre'] != "") {
        $titre = $_POST['titre'];
    }
    else {
        $titre = Null;
    }

    if (isset($_POST['annee']) && $_POST['annee'] != "") {
        $annee = $_POST['annee'];
    }
    else {
        $annee = Null;
    }
    
    if (isset($_POST['genre']) && $_POST['genre'] != ""){
        $genre = $_POST['genre'];
    }
    else {
    $genre = Null;
    }
    if (isset($_POST['label']) && $_POST['label'] != "") {
        $label = $_POST['label'];     
    }
    else {
        $label = Null;
    }

    if (isset($_POST['prix']) && $_POST['prix'] != "") {
        $prix = $_POST['prix'];
    }
    else {
        $prix = Null;
    }

    if (isset($_FILES['jaquette']) && $_FILES['jaquette']['error'] == 0) {
        if ($_FILES['jaquette']['size'] <= 5000000) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $file_info = pathinfo($_FILES['jaquette']['name']);
            $file_extension = strtolower($file_info['extension']);
            
            if (in_array($file_extension, $allowed_extensions)) {
                $file_name = uniqid('', true) . '.' . $file_extension;
                move_uploaded_file($_FILES['jaquette']['tmp_name'], 'jaquettes/' . $file_name);
                $jaquette = $file_name; 
            } 
            else {
                echo '<script>alert("Le type de fichier n\'est pas autorisé (jpg, jpeg, png)"); window.location.href="disc_new.php";</script>';
                exit;
            }
        } 
        else {
            echo '<script>alert("Le fichier est trop volumineux (max. 5 Mo)"); window.location.href="disc_new.php";</script>';
            exit;
        }
    } 
    else {
        $jaquette = Null;
    }
    
    
    
    if ($titre == Null || $annee == Null || $genre == Null || $label== Null || $select == Null || $jaquette == Null) {
        echo '<script>alert("Erreur : veuillez remplir les champs !"); window.location.href="disc_new.php";</script>';
        exit;
   }

require "db.php"; 
$db = connexionBase();

try {

    $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_genre, disc_label, disc_price, disc_picture, artist_id) VALUES (:title, :year, :genre, :label, :price, :picture, :artist_id);");

    
    $requete->bindValue(":title", $titre, PDO::PARAM_STR);
    $requete->bindValue(":year", $annee, PDO::PARAM_INT); 
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":price", $prix, PDO::PARAM_STR);
    $requete->bindValue(":picture", $jaquette, PDO::PARAM_STR);
    $requete->bindValue(":artist_id", $select, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->closeCursor();
    
}



catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    var_dump($requete);
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout.php)");
    
}

echo '<script>alert("Ajout du disque confirmé !"); window.location.href="disc.php";</script>';

exit;
?>