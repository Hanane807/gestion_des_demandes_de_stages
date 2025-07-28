<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nom = $_POST['search'];

    $rqt = $bdd->prepare('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id AND d.statut = "refusées" AND u.nom_complet = ? ');
    $rqt->execute([$nom]);
    
}
?>