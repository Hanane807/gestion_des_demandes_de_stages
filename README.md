📌 Présentation du projet
Ce projet est une application web permettant de gérer les demandes de stage pour un établissement. Il offre deux interfaces :

-Une interface étudiant pour soumettre une demande de stage.

-Une interface administrateur pour consulter, valider ou refuser les demandes.


🛠️ Technologies utilisées
-Front-end : HTML5, CSS3, JavaScript, Boxicons, Bootstrap

-Back-end : PHP 7+

-Base de données : MySQL (via WAMPServer)

-IDE recommandé : Visual Studio Code

🧪 Fonctionnalités
👨‍🎓 Étudiants :
Créer un compte

-Se connecter à leur espace personnel

-Soumettre une demande de stage (avec CV + lettre de motivation)

-Supprimer une demande

-Ajouter plusieurs demandes

-Modifier leur mot de passe

👩‍💼 Administrateurs :
-Se connecter à un espace sécurisé

-Voir toutes les demandes

-Valider ou refuser une demande

-Voir les statistiques (graphiques)

-Rechercher par nom

-Modifier son mot de passe

⚙️ Installation
1-Cloner le projet :

git clone https://github.com/ton-utilisateur/gestion_stages.git

2-Démarrer WAMPServer et ouvrir phpMyAdmin

3-Importer la base de données :

Créer une base demandes_de_stage, puis exécuter ce script :

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50),
    role ENUM('admin', 'étudiant')
);

CREATE TABLE demandes_stages (
    id_demande INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    filiere VARCHAR(100),
    niveau VARCHAR(50),
    date_debut DATE,
    date_fin DATE,
    cv VARCHAR(255),
    lettre_motivation TEXT,
    statut ENUM('en attente', 'acceptée', 'refusée'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

4-Modifier les identifiants de connexion à la base dans php/connexion.php :

$bdd = new PDO('mysql:host=localhost;dbname=demandes_de_stage;charset=utf8', 'root', '');

5-Ouvrir le projet dans le navigateur :

http://localhost/gestion_des_demandes_de_stage/html/premier_inerface.html


📊 Exemple de compte Admin:

Email : nadiaazizi300@gmail.com
Mot de passe : nadia

Requête SQL à exécuter dans phpMyAdmin :
INSERT INTO `users`(`nom_complet`, `email`, `mdp`, `role`) 
VALUES ('Nadia Azizi','nadiaazizi300@gmail.com','nadia','admin');

📌 Auteurs
-Nom & Prénom : Nadia Azizi

-Encadrant : Madame Bakhtaoui Zakia

-Projet réalisé dans le cadre de : Stage d'initiation

-Année : 2025
