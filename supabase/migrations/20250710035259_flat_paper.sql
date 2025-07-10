/*
# Création de la table users

1. Nouvelle table
   - `users`
     - `id` (serial, primary key)
     - `nom` (varchar, nom de l'utilisateur)
     - `prenom` (varchar, prénom de l'utilisateur)
     - `adresse` (text, adresse de l'utilisateur)
     - `numero_tel` (varchar, numéro de téléphone unique)
     - `numero_cni` (varchar, numéro CNI unique)
     - `password` (varchar, mot de passe hashé)
     - `photo_recto` (varchar, nom du fichier photo recto)
     - `photo_verso` (varchar, nom du fichier photo verso)
     - `created_at` (timestamp, date de création)

2. Sécurité
   - Index unique sur numero_tel
   - Index unique sur numero_cni
   - Contraintes NOT NULL sur les champs obligatoires
*/

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresse TEXT NOT NULL,
    numero_tel VARCHAR(15) UNIQUE NOT NULL,
    numero_cni VARCHAR(20) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    photo_recto VARCHAR(255),
    photo_verso VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Index pour améliorer les performances de recherche
CREATE INDEX IF NOT EXISTS idx_users_numero_tel ON users(numero_tel);
CREATE INDEX IF NOT EXISTS idx_users_numero_cni ON users(numero_cni);