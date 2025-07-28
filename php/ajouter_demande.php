<?php
session_start();
require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $email = $_SESSION['email'];

    // Récupérer l'id de l'utilisateur connecté
    $stmt = $bdd->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "Utilisateur non trouvé.";
        exit;
    }

    $id_user = $user['id'];

    // Upload fichiers
    $cv = null;
    $lettre = null;

    if (!empty($_FILES['cv']['name'])) {
        $cv = 'cv_' . time() . '_' . $_FILES['cv']['name'];
        move_uploaded_file($_FILES['cv']['tmp_name'], '../uploads/' . $cv);
    }

    if (!empty($_FILES['lettre_motivation']['name'])) {
        $lettre = 'lettre_' . time() . '_' . $_FILES['lettre_motivation']['name'];
        move_uploaded_file($_FILES['lettre_motivation']['tmp_name'], '../uploads/' . $lettre);
    }

    // Insertion
    $rqt = $bdd->prepare("INSERT INTO demandes_stages (id_user, filiere, niveau, date_debut, date_fin, cv, lettre_motivation, statut, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'en attente', NOW())");

    $rqt->execute([$id_user, $filiere, $niveau, $date_debut, $date_fin, $cv, $lettre]);

    header("Location: etudiant_dashboard.php");
    exit();
}
?>
