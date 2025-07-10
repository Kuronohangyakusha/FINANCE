<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'alchimiste du code - Commande #12345</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-green': '#0f1b0f',
                        'green-accent': '#22c55e',
                        'dark-gray': '#1a1a1a',
                        'light-gray': '#2a2a2a'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark-green text-white min-h-screen">
    <!-- Header -->
    <header class="bg-dark-gray border-b border-gray-700 px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-green-accent rounded-full flex items-center justify-center">
                    <span class="text-xs font-bold text-black">⚗</span>
                </div>
                <h1 class="text-lg font-semibold">L'alchimiste du code</h1>
            </div>
            <nav class="flex space-x-8">
                <a href="App.php?page=lister-commandes" class="text-white font-semibold">Commandes</a>
                <a href="App.php?page=voir-paiements" class="text-gray-300 hover:text-white">Paiements</a>
                <a href="App.php?page=generer-facture" class="text-gray-300 hover:text-white">Factures</a>
                <div class="w-8 h-8 bg-gray-600 rounded-full"></div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Command Header -->
        <div class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-3xl font-bold mb-2">Commande #12345</h2>
                <p class="text-gray-400">Commande le 02/20/2000</p>
            </div>
            <div class="text-right text-sm text-gray-300">
                <p>Nom: DIASSY</p>
                <p>Prénom: BAKARY</p>
                <p>Téléphone: 777777777</p>
                <p>Total: 1570,00fcfa</p>
                <p>Montant payé: 1500 FCFA</p>
                <p class="text-red-400">Statut: impayé</p>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-light-gray rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold mb-4">Résumé de la Commande</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="pb-3 font-medium">Produit</th>
                            <th class="pb-3 font-medium">Quantité</th>
                            <th class="pb-3 font-medium">Prix</th>
                            <th class="pb-3 font-medium">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        <tr class="border-b border-gray-700">
                            <td class="py-3">Riz</td>
                            <td class="py-3">100</td>
                            <td class="py-3">10000</td>
                            <td class="py-3">1000,000fcfa</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">Lait</td>
                            <td class="py-3">50</td>
                            <td class="py-3">2000</td>
                            <td class="py-3">2000000fcfa</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">sucre</td>
                            <td class="py-3">200</td>
                            <td class="py-3">500</td>
                            <td class="py-3">5000000fcfa</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center items-center space-x-2 mt-6">
                <button class="p-2 text-gray-400 hover:text-white">‹</button>
                <button class="w-8 h-8 bg-green-accent text-black rounded-full font-semibold">1</button>
                <button class="w-8 h-8 text-gray-400 hover:text-white">2</button>
                <button class="w-8 h-8 text-gray-400 hover:text-white">3</button>
                <button class="p-2 text-gray-400 hover:text-white">›</button>
            </div>
        </div>

        <!-- Invoice Section -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">facture</h3>
            <a href="App.php?page=generer-facture" class="bg-green-accent text-black px-6 py-2 rounded-lg font-semibold hover:bg-green-500">
                Génerer Facture
            </a>
        </div>

        <!-- Payment Section -->
        <div class="bg-light-gray rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4">Paiement</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="pb-3 font-medium">Date</th>
                            <th class="pb-3 font-medium">Montant-Total</th>
                            <th class="pb-3 font-medium">Methode</th>
                            <th class="pb-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        <tr>
                            <td class="py-3">July 19 2024</td>
                            <td class="py-3">200000fcfa</td>
                            <td class="py-3">Carte Credit</td>
                            <td class="py-3">
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Payé</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                <a href="App.php?page=voir-paiements" class="bg-green-accent text-black px-6 py-2 rounded-lg font-semibold hover:bg-green-500">
                    Enregistrer un paiement
                </a>
            </div>
        </div>
    </main>
</body>
</html>