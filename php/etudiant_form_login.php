<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = isset($_POST['email'])? $_POST['email'] : '';
    $mdp = isset($_POST['mdp'])? $_POST['mdp'] : '';
    $_SESSION['email'] = $email;

    $request = $bdd->prepare("SELECT * FROM users WHERE email = ? AND mdp = ? AND role = 'étudiant'");
    $request->execute([$email, $mdp]);

    if ($request->rowCount() > 0) {
        header('Location:../php/etudiant_dashboard.php');
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Email ou mot de passe incorrect.</p>";
    }
}
?>