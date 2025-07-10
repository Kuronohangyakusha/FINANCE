/*
# Création de la table comptes

1. Nouvelle table
   - `comptes`
     - `id` (serial, primary key)
     - `user_id` (integer, foreign key vers users)
     - `numero_tel` (varchar, numéro de téléphone)
     - `photo_recto` (varchar, nom du fichier photo recto)
     - `photo_verso` (varchar, nom du fichier photo verso)
     - `numero_cni` (varchar, numéro CNI)
     - `solde` (integer, solde du compte en centimes)
     - `type_compte` (varchar, type de compte)
     - `created_at` (timestamp, date de création)

2. Sécurité
   - Foreign key vers la table users
   - Index sur user_id pour les performances
*/

CREATE TABLE IF NOT EXISTS comptes (
    id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    numero_tel VARCHAR(15) NOT NULL,
    photo_recto VARCHAR(255),
    photo_verso VARCHAR(255),
    numero_cni VARCHAR(20) NOT NULL,
    solde INTEGER DEFAULT 0,
    type_compte VARCHAR(20) DEFAULT 'principal',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Index pour améliorer les performances
CREATE INDEX IF NOT EXISTS idx_comptes_user_id ON comptes(user_id);
CREATE INDEX IF NOT EXISTS idx_comptes_numero_tel ON comptes(numero_tel);