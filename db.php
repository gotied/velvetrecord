<?php

function connexionBase(){

    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=record;charset=utf8', 'admin', 'L@l0102');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
}
    catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die('Fin du script');
}
}
?>