<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link href='../css/admin_dashboard.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class='sidebar' >
            <div class='entete'>  
                <i class='bx bxs-user-circle'></i><br>
                <h2> Admin </h2>
            </div>
            <a href='#' class="dashboard" onclick="affichage_board()"><i class='bx bxs-dashboard'></i> Tableau de bord</a>  
            <a href='#' class="demandes" onclick="affichage_demande()"><i class='bx bx-disc'></i> Demandes</a>   
            <a href='#' class="valider" onclick="affichage_valider()"><i class='bx bx-check-square' ></i> Demandes validés</a>   
            <a href='#' class="rejete" onclick="affichage_rejeter()"><i class='bx bxs-trash'></i> Demandes rejetés</a>   
            <a href='#' onclick="affichage_stat()"><i class='bx bxs-pie-chart-alt-2'></i> Statistiques</a>   
            <a href='#' onclick="affichage_para()"><i class='bx bxs-brightness'></i> Paramétres</a>   
            <a href='#' onclick='dec()'><i class='bx bx-log-out'></i> Déconnexion</a>   

    </div>
    <div class='main-content'>
                <div class='dashboard_container' id='dashboard' style="display: <?php echo (!empty($_GET['search_all']) || !empty($_GET['search_valider']) || !empty($_GET['search_rejeter'])) ? 'none' : 'block'; ?>;">
                <div class="en_tete">   
                <h1>Tableau de bord Admin</h1>
                <div class="btn">
                    <button onclick="location.href='../html/premier_inerface.html';"><i class='bx bxs-home'></i></button>
                </div>
                </div>
                <div class='btn-control'>
                    <button onclick="affichage_stat()"><i style='color: #2c7eb9' class='bx bxs-pie-chart-alt-2'></i> Statistiques </button>
                    <button onclick="affichage_demande()"><i style='color:rgb(49, 206, 86)' class='bx bxs-folder-open' ></i> Demandes </button>
                    <button onclick="affichage_valider()"><i style='color:rgb(240, 237, 53)' class='bx bxs-check-shield'></i> Validés </button>
                    <button onclick="affichage_rejeter()"><i style='color:rgb(221, 81, 15)' class='bx bxs-shield-x'></i> Rejetés </button>
                </div>
                <table class='tab'>
                    <thead>
                        <tr> <th colspan='5'> Dernières dix demandes </th> </tr>
                        <tr>
                            <th> ID demande </th>
                            <th> Nom & Prénom </th>
                            <th> Date </th>
                            <th> Statut </th>
                            <th class="col_action" style="width: 160px"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $requete = $bdd->query('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id ORDER BY d.created_at DESC LIMIT 10');
                        while($donnees=$requete->fetch()){
                            $id = $donnees['id_demande'];
                            $time =$donnees['created_at'];
                            $statut = $donnees['statut'];
                            $nom = $donnees['nom_complet'];
                            $data = htmlspecialchars(json_encode($donnees), ENT_QUOTES, 'UTF-8');

                            echo "<tr>
                                <td> $id </td>
                                <td> $nom </td>
                                <td> $time </td>
                                <td class='statut'> $statut </td>
                                <td> <a href='#' class='modal-btn' data-info='{$data}'>Voir <i class='bx bx-show'></i>
                                    </a>  <a href='#' class='edit-btn' data-info='{$data}' style='margin-left:20px;'>Edit <i class='bx bxs-pencil'></i></a></td>

                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-container">
                <div class="overlay"></div>

                <div class="modal">
                    <button class="close-modal" >X</button>
                    <p class="modal-content">

                    </p>
                </div>
            </div>
            <div class='modal-cont'>
                <div class='over'></div>
                <div class='modal-edit'>
                    <button class='btn-edit'>X</button>
                        <form method="post" action="update-demande.php">
                            <input type="hidden" name="id_demande" class="id_demande" >
                            <label for="statut">Statut</label>
                            <input type="text" name="statut" id="statut" class="sta">

                            <button type="submit" class="btn-save">Enregistrer</button>
                        </form>
                </div>
            </div>

            <div class="demande_container" id="demande_container" style="display: <?php echo (!empty($_GET['search_all'])) ? 'block' : 'none'; ?>;">
             <div class="entete">
                <h1>Toutes les demandes envoyées </h1>
                <form action="admin_dashboard.php" class="form">
                    <input type="text" class="search_all" name="search_all" placeholder=" Rechercher...">
                    <button type="submit"><i class='bx bx-search-alt-2'></i></button>
                </form>
             </div>
                <table class='tab'>
                    <thead>
                        <tr>
                            <th> ID demande </th>
                            <th> Nom & Prénom </th>
                            <th> Date </th>
                            <th> Statut </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $donnees =[];
                        if (!empty($_GET['search_all'])){
                            $nom = $_GET['search_all'];
                            $requete = $bdd->prepare('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id WHERE u.nom_complet LIKE ? ORDER BY d.created_at DESC');
                            $requete->execute(["%$nom%"]);
                            $donnees = $requete->fetchAll();
                        }else{
                        $requete = $bdd->query('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id ORDER BY d.created_at DESC');
                        $donnees = $requete->fetchAll();
                        }
                        foreach($donnees as $donnee){
                            $id = $donnee['id_demande'];
                            $time =$donnee['created_at'];
                            $statut = $donnee['statut'];
                            $nom = $donnee['nom_complet'];
                            $data = htmlspecialchars(json_encode($donnee), ENT_QUOTES, 'UTF-8');

                            echo "<tr>
                                <td> $id </td>
                                <td> $nom </td>
                                <td> $time </td>
                                <td class='statut'> $statut </td>
                                <td> <a href='#' class='modal-btn' data-info='{$data}'>Voir <i class='bx bx-show'></i>
                                    </a>  <a href='#' class='edit-btn' data-info='{$data}' style='margin-left:20px;'>Edit <i class='bx bxs-pencil'></i></a></td>

                            </tr>";
                        }
                        ?>
                        </tbody>
                </table>
        </div>

        <div class="valider_container" id="valider_container">
            <div class="entete">
                <h1>Toutes les demandes validées </h1>
            </div>
                <table class='tab'>
                    <thead>
                        <tr>
                            <th> ID demande </th>
                            <th> Nom & Prénom </th>
                            <th> Date </th>
                            <th> Statut </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $donnees =[];
                        if (!empty($_GET['search_valider'])){
                            $nom = $_GET['search_valider'];
                            $requete = $bdd->prepare('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id WHERE d.statut = "acceptée" AND u.nom_complet LIKE ? ORDER BY d.created_at DESC');
                            $requete->execute(["%$nom%"]);
                            $donnees = $requete->fetchAll();
                        }else{
                        $requete = $bdd->query('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id WHERE d.statut = "acceptée" ORDER BY d.created_at DESC');
                        $donnees = $requete->fetchAll();
                        }
                        foreach($donnees as $donnee){
                            $id = $donnee['id_demande'];
                            $time =$donnee['created_at'];
                            $statut = $donnee['statut'];
                            $nom = $donnee['nom_complet'];
                            $data = htmlspecialchars(json_encode($donnee), ENT_QUOTES, 'UTF-8');

                            echo "<tr>
                                <td> $id </td>
                                <td> $nom </td>
                                <td> $time </td>
                                <td class='statut'> $statut </td>
                                <td> <a href='#' class='modal-btn' data-info='{$data}'>Voir <i class='bx bx-show'></i>
                                    </a>  <a href='#' class='edit-btn' data-info='{$data}' style='margin-left:20px;'>Edit <i class='bx bxs-pencil'></i></a></td>

                            </tr>";
                        }
                     ?>
                    </tbody>
                </table>
        </div>

        <div class="rejeter_container" id="rejeter_container">
            <div class="entete">
                <h1>Toutes les demandes refusées </h1>
            </div>
                <table class='tab'>
                    <thead>
                        <tr>
                            <th> ID demande </th>
                            <th> Nom & Prénom </th>
                            <th> Date </th>
                            <th> Statut </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                        $donnees =[];
                        if (!empty($_GET['search_rejeter'])){
                            $nom = $_GET['search_rejeter'];
                            $requete = $bdd->prepare('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id WHERE d.statut = "refusée" AND u.nom_complet LIKE ? ORDER BY d.created_at DESC');
                            $requete->execute(["%$nom%"]);
                            $donnees = $requete->fetchAll();
                        }else{
                        $requete = $bdd->query('SELECT d.id_demande,d.created_at, d.statut ,u.nom_complet, u.email, d.filiere, d.niveau, d.date_debut, d.date_fin, d.cv, d.lettre_motivation FROM demandes_stages d JOIN users u ON d.id_user = u.id WHERE d.statut = "refusée" ORDER BY d.created_at DESC');
                        $donnees = $requete->fetchAll();
                        }
                        foreach($donnees as $donnee){
                            $id = $donnee['id_demande'];
                            $time =$donnee['created_at'];
                            $statut = $donnee['statut'];
                            $nom = $donnee['nom_complet'];
                            $data = htmlspecialchars(json_encode($donnee), ENT_QUOTES, 'UTF-8');

                            echo "<tr>
                                <td> $id </td>
                                <td> $nom </td>
                                <td> $time </td>
                                <td class='statut'> $statut </td>
                                <td> <a href='#' class='modal-btn' data-info='{$data}'>Voir <i class='bx bx-show'></i>
                                    </a>  <a href='#' class='edit-btn' data-info='{$data}' style='margin-left:20px;'>Edit <i class='bx bxs-pencil'></i></a></td>

                            </tr>";
                        }
                     ?>
                    </tbody>
                </table>
        </div>

        <div class="statistic">
            <h1>Statistiques</h1>
            <div class="container_graph">
            <div class="first">
                <h2>Demandes de stages par moi</h2>
                <?php
                $rqt = $bdd->query('SELECT MONTH(created_at) AS mois, COUNT(*) AS total FROM demandes_stages GROUP BY mois');
                $labels = [];
                $data = [];
                while($rslt = $rqt->fetch()){
                    $mois_noms = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
                    $labels[] = $mois_noms[$rslt['mois']-1];
                    $data[] = $rslt['total'];
                }
                ?>

                <canvas id="firstGraph"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const labels = <?php echo json_encode($labels); ?>;
                    const data = <?php echo json_encode($data); ?>;

                    const ctx = document.getElementById('firstGraph').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Demandes de stages par mois',
                                data: data,
                                backgroundColor: 'rgb(82, 65, 232)'
                            }]
                        }
                    });
                </script>
            </div>

            <div class="second">
                <h2>Répartition des demandes de stages</h2>
                <?php
                $rqt2 = $bdd->query('SELECT statut , COUNT(*) AS total FROM demandes_stages GROUP BY statut');
                $labels2 = [];
                $data2 = [];
                while($rslt = $rqt2->fetch()){
                    $labels2[] =$rslt['statut'];
                    $data2[] = $rslt['total'];
                }
                ?>

                <canvas id="secondGraph"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const labels2 = <?php echo json_encode($labels2); ?>;
                    const data2 = <?php echo json_encode($data2); ?>;

                    const ctx2 = document.getElementById('secondGraph').getContext('2d');
                    new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: labels2,
                            datasets: [{
                                label: 'Répartition des demandes',
                                data: data2,
                                backgroundColor: ['rgb(232, 148, 65)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgb(226, 221, 68)']
                            }]
                        }
                    });
                </script>
            </div>
            </div>

        </div>

        <div class="para_container">
            <h1>Paramétres</h1>
            <div class="update">
                <h3>Modifier le mot de passe </h3>
                <form action="update_pwd.php" method="post">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email">
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
       
        <script src="../js/admin_dashboard.js"></script>
</body>
</html>