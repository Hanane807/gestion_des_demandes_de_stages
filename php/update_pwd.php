<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $pwd_actuel = $_POST['actuel'];
    $pwd_new = $_POST['new'];
    $pwd_confirm = $_POST['confirm'];

        $requette = $bdd->prepare('SELECT mdp FROM users where role = "admin" and email = ?');
        $requette->execute([$email]);
        $donnees = $requette->fetch();

        if(($donnees) && ($pwd_actuel === $donnees['mdp'])){
          if($pwd_new === $pwd_confirm){
            $rqt = $bdd->prepare('UPDATE users SET mdp = ? WHERE email = ?');
            $rqt->execute([$pwd_new,$email]); 
            
            echo "le mot de passe mis à jour avec succès.";
            }else{
                echo "le mot de passe ne correspondent pas.";
            }
        }else{
            echo "le mot de passe actuel est incorecte";
        }
}
?>