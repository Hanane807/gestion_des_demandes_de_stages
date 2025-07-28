
# 🎓 Gestion des Demandes de Stage

Ce projet est une **application web complète** permettant à un établissement de **gérer les demandes de stage**. Il comprend deux interfaces :  
- 👨‍🎓 Une interface **étudiant** pour soumettre et suivre les demandes  
- 👩‍💼 Une interface **administrateur** pour gérer et suivre toutes les demandes  

---

## 🛠️ Technologies utilisées

| Côté | Outils |
|------|--------|
| Front-end | `HTML5`, `CSS3`, `JavaScript`, `Bootstrap`, `Boxicons` |
| Back-end | `PHP 7+` |
| Base de données | `MySQL` via `WAMPServer` |
| IDE recommandé | `Visual Studio Code` |

---

## ✨ Fonctionnalités

### 👨‍🎓 Côté Étudiant :
- Création de compte
- Connexion à l’espace personnel
- Soumission de demande de stage (CV + lettre de motivation)
- Suppression d’une demande
- Ajout de plusieurs demandes
- Modification du mot de passe

### 👩‍💼 Côté Administrateur :
- Connexion sécurisée
- Consultation des demandes
- Validation ou refus des demandes
- Statistiques visuelles (graphiques)
- Recherche par nom d’étudiant
- Modification du mot de passe

---

## ⚙️ Installation du projet

1. **Cloner le dépôt Git :**

   ```bash
   git clone https://github.com/Nadia497/gestion_des_demandes_de_stages.git
   ```

2. **Lancer WAMPServer** et accéder à [phpMyAdmin](http://localhost/phpmyadmin)

3. **Créer la base de données** `demandes_de_stage` puis importer la structure suivante :

   ```sql
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
   ```

4. **Ajouter un compte administrateur par défaut** :

   ```sql
   INSERT INTO users (nom_complet, email, mdp, role)
   VALUES ('Nadia Azizi', 'nadiaazizi300@gmail.com', 'nadia', 'admin');
   ```

5. **Modifier la connexion à la base de données dans `php/connexion.php`** :

   ```php
   $bdd = new PDO('mysql:host=localhost;dbname=demandes_de_stage;charset=utf8', 'root', '');
   ```

6. **Lancer l'application dans votre navigateur** :

   ```
   http://localhost/gestion_des_demandes_de_stage/html/premier_inerface.html
   ```

---

## 🔐 Compte Admin de démonstration

| Email | Mot de passe |
|-------|--------------|
| `nadiaazizi300@gmail.com` | `nadia` |

---

## 👩‍🏫 Encadrement et crédits

- 👩‍💻 **Développeuse** : Nadia Azizi  
- 🎓 **Encadrante** : Madame **Bakhtaoui Zakia**  
- 📚 **Projet réalisé dans le cadre d’un stage d’initiation**  
- 📅 **Année académique** : 2025

