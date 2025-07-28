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