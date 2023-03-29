<?php
// Récupération de l'ID du disque à modifier :
$id = (isset($_POST['disc_id']) && $_POST['disc_id'] != "") ? $_POST['disc_id'] : Null;


// Vérification si l'ID est défini:
if ($id === Null) {
    echo '<script>alert("Erreur : identifiant du disque introuvable !"); window.location.href="disc.php";</script>';
    exit;
}

// Récupération des autres valeurs:
$select = (isset($_POST['select_artist']) && $_POST['select_artist'] != "") ? $_POST['select_artist'] : Null;
$year = (isset($_POST['annee']) && $_POST['annee'] != "") ? $_POST['annee'] : Null;
$genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$prix = (isset($_POST['prix']) && $_POST['prix'] != "") ? $_POST['prix'] : Null;

// Connexion à la base de données :
require "db.php"; 
$db = connexionBase();

// Récupération de l'image :
// Vérification qu'il n'y est pas d'erreur 
// Vérification taille du fichier (5mo), sinon erreur
// Stockage dans un tableau des extensions autorisé
// Stockage dans un tableau associatif du nom du fichier, de l'extension du fichier, etc
// Stockage de l'extension en minuscule 
// Vérification de l'extension, sinon erreur
// Génére un nom unique 
// Déplace le fichier dans un dossier 
// Stockage de la valeur 
// Sinon $valeur = Null
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
            echo '<script>alert("Le type de fichier n\'est pas autorisé (jpg, jpeg, png)"); window.location.href="disc_modif.php?id='.$id.'";</script>';
            exit;
        }
    } 
    else {
        echo '<script>alert("Le fichier est trop volumineux (max. 5 Mo)"); window.location.href="disc_modif.php?id='.$id.'";</script>';
        exit;
    }
} 
else {
    $jaquette = Null;
}

// Vérification si toutes les données sont définies:
if ($select === Null || $year === Null || $label === Null || $genre === Null || $prix === Null ) {
    echo '<script>alert("Erreur : veuillez remplir les champs !"); window.location.href="disc_modif.php?id='.$id.'";</script>';
    exit;
}




try {
    // Construction de la requête UPDATE :
    $requete = $db->prepare("UPDATE disc SET disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price, artist_id = :artistid WHERE disc_id = :discid;");
    $requete->bindValue(":discid", $id, PDO::PARAM_INT);
    $requete->bindValue(":artistid", $select, PDO::PARAM_INT);
    $requete->bindValue(":year", $year, PDO::PARAM_STR);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":price", $prix, PDO::PARAM_STR);
    
    $requete->execute();
    $requete->closeCursor();




    
    // Deuxième requête UPDATE avec une condition :
    if ($jaquette !== Null) {
        $requete2 = $db->prepare("UPDATE disc SET disc_picture = :picture WHERE disc_id = :discid;");
        $requete2->bindValue(":picture", $jaquette, PDO::PARAM_STR);
        $requete2->bindValue(":discid", $id, PDO::PARAM_INT);
        $requete2->execute();
        $requete2->closeCursor();
    }
}

catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    var_dump($requete);
    var_dump($requete2->queryString);
    var_dump($requete2->errorInfo());
    var_dump($requete2);
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_modif.php)");
}

// Si OK, redirection vers : 
echo '<script>alert("Modification enregistré !"); window.location.href="disc_detail.php?id='.$id.'";</script>';
exit;
?>