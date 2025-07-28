CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50),
    role ENUM('admin', 'étudiant')
);