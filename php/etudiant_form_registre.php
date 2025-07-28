<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nom = isset($_POST['nom'])? $_POST['nom'] : '';
    $email = isset($_POST['email'])? $_POST['email'] : '';
    $mdp = isset($_POST['mdp'])? $_POST['mdp'] : '';
    $filiere = isset($_POST['filiere'])? $_POST['filiere'] : '';
    $niveau = isset($_POST['niveau'])? $_POST['niveau'] : '';
    $date_debut = isset($_POST['DDebut'])? $_POST['DDebut'] : '';
    $date_fin = isset($_POST['DFin'])? $_POST['DFin'] : '';

    $_SESSION['email'] = $email;

    $check = $bdd->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if($check->rowCount() > 0){
        echo "cette email est déjà utilisé.";
        exit;
    }

    $cv_path = '';
    if(isset($_FILES['cv']) && $_FILES['cv']['error'] === 0){
        $cv_tmp = $_FILES['cv']['tmp_name'];
        $cv_name =  'cv_' . time() . '_' . $_FILES['cv']['name'];
        $cv_path = '../uploads/'.$cv_name;
        move_uploaded_file($_FILES['cv']['tmp_name'], '../uploads/' . $cv_name);
    }

    $lettre_path = 'Aucune';
    if (isset($_FILES['LMotiv']) && $_FILES['LMotiv']['error'] === 0) {
        $lettre_tmp = $_FILES['LMotiv']['tmp_name'];
        $lettre_name = time() . '_' . basename($_FILES['LMotiv']['name']);
        $lettre_path = '../uploads/' . $lettre_name;
        move_uploaded_file($lettre_tmp, $lettre_path);
    }

    $requete = $bdd->prepare("INSERT INTO users(nom_complet,email,mdp,role) VALUES(:nom,:email,:mdp, 'étudiant')");
    $requete->execute(array(
        'nom' => $nom,
        'email' => $email,
        'mdp' => $mdp
    ));

    $id_user = $bdd->lastInsertId();

    $rqt = $bdd->prepare("INSERT INTO demandes_stages(id_user,filiere,niveau,date_debut,date_fin,cv,lettre_motivation)  
                            VALUES(:id_user,:filiere,:niveau,:date_debut,:date_fin,:cv,:lettre_motivation)");
    $rqt->execute(array(
        'id_user' => $id_user,
        'filiere' => $filiere,
        'niveau' => $niveau,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'cv' => $cv_path,
        'lettre_motivation' => $lettre_path
    ));

    header('Location:../php/etudiant_dashboard.php');
    exit();
}
?>