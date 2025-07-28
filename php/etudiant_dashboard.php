<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des demandes de stages</title>
    <link href='../css/etudiant_dashboard.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class='sidebar' >
            <div class='entete'>  
                <i class='bx bxs-user-circle'></i><br>
                <h2> <?php
                if(isset($_SESSION['email'])){
                 $rqt = $bdd->prepare('SELECT nom_complet FROM users WHERE email = ?');
                 $rqt->execute([$_SESSION['email']]);
                 $rslt = $rqt->fetch();
                 echo htmlspecialchars($rslt['nom_complet']);
                 } else{
                    echo "Utilisateur";
                 }?> </h2>
            </div>
            <a href='#' class="dashboard" onclick="affichage_board()"><i class='bx bxs-dashboard'></i> Tableau de bord</a>    
            <a href='#' onclick="affichage_para()"><i class='bx bxs-brightness'></i> Paramétres</a>   
            <a href='#' onclick='dec()'><i class='bx bx-log-out'></i> Déconnexion</a>   

    </div>
    <div class='main-content'>
        <div class="dashboard_container">
                 <div class="en_tete">
                    <h1>Tableau de bord </h1>
                    <div class="btn">
                    <button onclick="location.href='../html/ajout_demande.html';  console.log('btn click!');" style="cursor:pointer;"><i class='bx bx-plus'></i></button>
                    <button onclick="location.href='../html/premier_inerface.html';"><i class='bx bxs-home'></i></button>
                    <button id="delete_all_btn"><i class='bx bxs-trash'></i></button></div>
                </div>
                <table class='tab'>
                    <thead>
                        <tr>
                            <th class="date"> Date </th>
                            <th class="statuut"> Statut</th>
                            <th class="col_action"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $requete = $bdd->prepare('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id WHERE u.email = ? ORDER BY d.created_at DESC');
                        $requete->execute([$_SESSION['email']]);
                        while($donnees=$requete->fetch()){
                            $time =$donnees['created_at'];
                            $statut = $donnees['statut'];
                            $data = htmlspecialchars(json_encode($donnees), ENT_QUOTES, 'UTF-8');

                            echo "<tr>
                                <td> $time </td>
                                <td class='statut'> $statut </td>
                                <td> <a href='#' class='modal-btn' data-info='{$data}'><i class='bx bxs-show' style='color: green;'></i></a>
                                    <a href='#' class='supp' data-id='{$donnees['id_demande']}'>   <i class='bx bxs-trash' style='color: red;'></i></a>
                                </td>

                            </tr>";
                        }
                    
                        ?>
                    </tbody>
                </table>

                <p class="note-important" style="margin: 20px; font-size: 16px; color: #333; background: #fff8c4; padding: 15px; border-left: 5px solid #f0ad4e; border-radius: 5px;">
                    <strong>Important :</strong> En cas d'acceptation de votre demande de stage, vous devez vous présenter dans un délai de <strong>7 jours maximum</strong> avec les documents demandés : <br>
                    • Une copie de votre <strong>CV</strong> <br>
                    • Votre <strong>lettre de motivation</strong> <br>
                    • Une copie de votre <strong>demande validée</strong> <br><br>
                    Veuillez respecter ce délai pour valider votre candidature.
                </p>

        </div>

        <div class="modal-container">
                <div class="overlay"></div>

                <div class="modal">
                    <button class="close-modal" >X</button>
                    <p class="modal-content">

                    </p>
                </div>
            </div>

        <div class="para_container">
            <h1>Paramétres</h1>
            <div class="update">
                <h3>Modifier le mot de passe </h3>
                <form action="update_mdp.php" method="post">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email_pwd">
                    <label for="actuel">Mot de passe actuel</label>
                    <input type="password" id="actuel" name="actuel">
                    <label for="new">Nouveau mot de passe</label>
                    <input type="password" id="new" name="new">
                    <label for="confirm">Confirmer le mot de passe</label>
                    <input type="password" id="confirm" name="confirm">
                    <button type="submit">Enregistrer</button>
                </form>
            </div>
        </div>

    </div>

    <script src="../js/etudiant_dashboard.js"></script>
</body>
</html>