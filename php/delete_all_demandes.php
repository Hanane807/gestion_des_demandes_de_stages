<?php
session_start();
require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $rqt = $bdd->prepare('SELECT id FROM users WHERE email = ?');
    $rqt->execute([$email]);
    $rslt = $rqt->fetch();

    if($rslt){
        $id_user = $rslt['id'];

        $delete = $bdd->prepare('DELETE FROM demandes_stages WHERE id_user = ?');
        $delete->execute([$id_user]);

        $delete_user = $bdd->prepare('DELETE FROM users WHERE id = ?');
        $delete_user->execute([$id_user]);

        session_unset();
        session_destroy();

        echo "redirect";
        exit();
    } else{
        echo "user_not_found";
    }
} else{
    echo "error";
}
?>