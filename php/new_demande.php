<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'connexion.php';

if(!isset($_SESSION['email'])){
    die("Utilisateur introuvable!!");
}

$rqt = $bdd->prepare("SELECT id FROM users WHERE email = ?");
$rqt->execute([$_SESSION['email']]);
$rslt = $rqt->fetch();

if(!isset($rslt)){
    die('Utilisateur introuvable.');
}

$id_user = $rslt['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];
    $Ddebut = $_POST['dd'];
    $Dfin = $_POST['df'];

    $cv_path = '';
    if(isset($_FILES['cv']) && $_FILES['cv']['error'] === 0){
        $cv_tmp = $_FILES['cv']['tmp_name'];
        $cv_name =  'cv_' . time() . '_' . $_FILES['cv']['name'];
        $cv_path = '../uploads/'.$cv_name;
        move_uploaded_file($_FILES['cv']['tmp_name'], '../uploads/' . $cv_name);
    }

    $lettre_path = 'Aucune';
    if (isset($_FILES['lm']) && $_FILES['lm']['error'] === 0) {
        $lettre_tmp = $_FILES['lm']['tmp_name'];
        $lettre_name = time() . '_' . basename($_FILES['lm']['name']);
        $lettre_path = '../uploads/' . $lettre_name;
        move_uploaded_file($lettre_tmp, $lettre_path);
    }

    $stmt = $bdd->prepare("INSERT INTO demandes_stages (id_user, filiere, niveau, date_debut, date_fin, cv, lettre_motivation,statut, created_at)
                            VALUES (?,?,?,?,?,?,?, 'en attente', NOW())");
        
    $stmt->execute([$id_user,$filiere,$niveau,$Ddebut,$Dfin,$cv_path,$lettre_path]);

    header("Location: etudiant_dashboard.php");
    exit();
}
?>