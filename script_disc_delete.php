<?php
   if (isset($_GET["id"])) {
       $id = $_GET["id"];
       
       require "db.php"; 
       $db = connexionBase();
   
       try {
           $requete = $db->prepare("DELETE FROM disc WHERE disc_id = ?");
           $requete->execute(array($id));
           $requete->closeCursor();
           
       }
       catch (Exception $e) {
           echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
           die("Fin du script (script_disc_delete.php)");
       }
   } 
   else {
    echo '<script>alert("Erreur : identifiant du disque introuvable !"); window.location.href="disc.php";</script>';
    exit;
   }
   echo '<script>alert("Disque supprimé !"); window.location.href="disc.php";</script>';
   exit;
   ?>