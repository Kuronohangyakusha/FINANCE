<?php
namespace Vendor\Challenge2\views\commande;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer une commande</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h1>Enregistrer une commande</h1>
    
    <?php if (isset($message)): ?>
        <div class="alert alert-<?php echo $type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/commande/store">
        <div class="form-group">
            <label for="id">ID Commande:</label>
            <input type="number" id="id" name="id" required>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité:</label>
            <input type="number" id="quantite" name="quantite" required>
        </div>

        <div class="form-group">
            <label for="client_id">Client:</label>
            <select id="client_id" name="client_id" required>
                <option value="">Sélectionnez un client</option>
                <?php foreach ($clients as $client): ?>
                    <option value="<?php echo $client->getId(); ?>">
                        <?php echo htmlspecialchars($client->getNom()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="vendeur_id">Vendeur:</label>
            <select id="vendeur_id" name="vendeur_id" required>
                <option value="">Sélectionnez un vendeur</option>
                <?php foreach ($vendeurs as $vendeur): ?>
                    <option value="<?php echo $vendeur->getId(); ?>">
                        <?php echo htmlspecialchars($vendeur->getNom()); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="facture_id">ID Facture:</label>
            <input type="number" id="facture_id" name="facture_id" required>
        </div>

        <div class="form-group">
            <label for="numero_facture">Numéro Facture:</label>
            <input type="text" id="numero_facture" name="numero_facture" required>
        </div>

        <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="number" step="0.01" id="montant" name="montant" required>
        </div>

        <button type="submit">Enregistrer la commande</button>
    </form>
</body>
</html>