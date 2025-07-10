<body class="bg-gray-100 h-screen overflow-hidden">
    <div class="flex h-full">
        <!-- Menu toggle pour mobile -->
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        
        <!-- Sidebar -->
        <?php require_once __DIR__ . '/../layout/partial/header.partial.php'; ?>
        
        <!-- Overlay pour mobile -->
        <div class="overlay fixed inset-0 bg-black bg-opacity-50 z-10 md:hidden"></div>
        
        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-0">
            <!-- Header mobile avec menu burger -->
            <div class="md:hidden bg-white shadow-sm p-4 flex items-center justify-between">
                <h1 class="text-lg font-bold text-gray-900">Dashboard</h1>
                <label for="menu-toggle" class="cursor-pointer p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            
            <!-- Contenu scrollable -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Header avec informations utilisateur -->
                <div class="mb-6 md:mb-8">
                    <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-2 hidden md:block">
                        Bienvenue, <?= htmlspecialchars($user['prenom'] ?? '') ?> <?= htmlspecialchars($user['nom'] ?? '') ?>
                    </h1>
                    <p class="text-gray-600">Gérez votre compte et vos transactions</p>
                </div>
                
                <!-- Cartes d'informations -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Solde -->
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-orange-100 text-sm">Solde du compte</p>
                                <p class="text-3xl font-bold">7,500 FCFA</p>
                            </div>
                            <div class="bg-white bg-opacity-20 rounded-full p-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informations personnelles -->
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Informations</h3>
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Téléphone:</span> <?= htmlspecialchars($user['numero_tel'] ?? '') ?></p>
                            <p><span class="font-medium">CNI:</span> <?= htmlspecialchars($user['numero_cni'] ?? '') ?></p>
                            <p><span class="font-medium">Adresse:</span> <?= htmlspecialchars($user['adresse'] ?? '') ?></p>
                        </div>
                    </div>
                    
                    <!-- Actions rapides -->
                    <div class="bg-white rounded-lg p-6 shadow-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
                        <div class="space-y-3">
                            <button class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-colors text-sm">
                                Effectuer un dépôt
                            </button>
                            <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors text-sm">
                                Faire un retrait
                            </button>
                            <button class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg transition-colors text-sm">
                                Effectuer un paiement
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Tableau des transactions récentes -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Transactions récentes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Transaction</th>
                                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Type</th>
                                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Date</th>
                                    <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs md:text-sm font-medium text-gray-900">Montant</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">TXN001</td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Retrait
                                        </span>
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900"><?= date('d-m-Y') ?></td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900 font-medium">-1,500 FCFA</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">TXN002</td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Dépôt
                                        </span>
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900"><?= date('d-m-Y', strtotime('-1 day')) ?></td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900 font-medium">+5,000 FCFA</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">TXN003</td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Paiement
                                        </span>
                                    </td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900"><?= date('d-m-Y', strtotime('-2 days')) ?></td>
                                    <td class="px-3 md:px-6 py-3 md:py-4 text-xs md:text-sm text-gray-900 font-medium">-2,000 FCFA</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Footer avec actions -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-6 space-y-4 sm:space-y-0">
                    <div class="bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-6 py-3 w-full sm:w-auto text-center cursor-pointer transition-colors">
                        <span class="text-sm font-medium">Voir toutes les transactions</span>
                    </div>
                    <div class="bg-white rounded-lg shadow px-6 py-3 w-full sm:w-auto">
                        <div class="text-center">
                            <p class="text-sm text-gray-600">Compte créé le</p>
                            <p class="text-lg font-bold text-orange-500"><?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>