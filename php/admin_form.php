<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat de la connexion</title>
</head>
<body>
<?php
require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    $requete = $bdd->prepare("SELECT * FROM Users WHERE email = ? AND mdp = ? AND role = 'admin'");
    $requete->execute([$email, $mdp]);

    if ($requete->rowCount() > 0) {
        header('Location:../php/admin_dashboard.php');
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Email ou mot de passe incorrect.</p>";
    }
}
?>
</body>
</html>