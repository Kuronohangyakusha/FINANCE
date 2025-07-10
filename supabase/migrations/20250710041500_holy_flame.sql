/*
# Création de la table transactions

1. Nouvelle table
   - `transactions`
     - `id` (serial, primary key)
     - `compte_id` (integer, foreign key vers comptes)
     - `montant` (integer, montant de la transaction)
     - `date_transaction` (timestamp, date de la transaction)
     - `type_transaction` (varchar, type: depot, retrait, paiement)
     - `created_at` (timestamp, date de création)

2. Sécurité
   - Foreign key vers la table comptes
   - Index sur compte_id pour les performances
   - Index sur date_transaction pour les requêtes temporelles
*/

CREATE TABLE IF NOT EXISTS transactions (
    id SERIAL PRIMARY KEY,
    compte_id INTEGER NOT NULL,
    montant INTEGER NOT NULL CHECK (montant > 0),
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    type_transaction VARCHAR(20) NOT NULL CHECK (type_transaction IN ('depot', 'retrait', 'paiement')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (compte_id) REFERENCES comptes(id) ON DELETE CASCADE
);

-- Index pour améliorer les performances
CREATE INDEX IF NOT EXISTS idx_transactions_compte_id ON transactions(compte_id);
CREATE INDEX IF NOT EXISTS idx_transactions_date ON transactions(date_transaction);
CREATE INDEX IF NOT EXISTS idx_transactions_type ON transactions(type_transaction);