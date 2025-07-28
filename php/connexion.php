<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=demandes_de_stage;charset=utf8','root','');
}
catch (Exception $e){
    die("Erreur : ".$e->getMessage());
}

?>