<?php
session_start();
require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['id']) && isset($_SESSION['email'])){
    $id = $_POST['id'];
    //echo "id = ".$id; exit();
    $email = $_SESSION['email'];

    $rqt = $bdd->prepare('SELECT id FROM users WHERE email = ?');
    $rqt->execute([$email]);
    $rslt = $rqt->fetch();

    if($rslt){
        $id_user = $rslt['id'];
        $stmt = $bdd->prepare('SELECT COUNT(*) as nb FROM demandes_stages WHERE id_user = ?');
        $stmt->execute([$id_user]);
        $nmbr = $stmt->fetch();

        $delete = $bdd->prepare('DELETE FROM demandes_stages WHERE id_demande = ? AND id_user = ?');
        $delete->execute([$id,$id_user]);

        if($nmbr['nb'] == 1){
            $delete_user = $bdd->prepare('DELETE FROM users WHERE id = ?');
            $delete_user->execute([$id_user]);

            session_unset();
            session_destroy();

            echo "redirect";
            exit();
        }
        echo "success";
    } else{
        echo "user_not_found";
    }
} else{
    echo "error";
}
?>