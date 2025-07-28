<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id_demande'];
    $statut = $_POST['statut'];
    $desc = $_POST['description'];

    $rqt = $bdd->prepare('UPDATE demandes_stages set statut = ?, description = ? WHERE id_demande = ?');
    $rqt->execute([$statut,$desc,$id]);

    header('Location: admin_dashboard.php');
    exit();
}
?>