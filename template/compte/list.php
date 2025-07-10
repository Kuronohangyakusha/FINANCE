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
                <h1 class="text-lg font-bold text-gray-900">Liste des Comptes</h1>
                <label for="menu-toggle" class="cursor-pointer p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            
            <!-- Contenu scrollable -->
            <div class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Header -->
                <div class="mb-6 md:mb-8">
                    <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-2 hidden md:block">
                        Mes Comptes
                    </h1>
                    <p class="text-gray-600">Gérez tous vos comptes financiers</p>
                </div>
                
                <!-- Bouton créer nouveau compte -->
                <div class="mb-6">
                    <a href="/compte/create" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                        Créer un nouveau compte
                    </a>
                </div>
                
                <!-- Liste des comptes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (empty($comptes)): ?>
                        <div class="col-span-full bg-white rounded-lg p-8 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun compte trouvé</h3>
                            <p class="text-gray-600 mb-4">Vous n'avez pas encore créé de compte.</p>
                            <a href="/compte/create" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Créer votre premier compte
                            </a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($comptes as $compte): ?>
                            <div class="bg-white rounded-lg shadow-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Compte <?= htmlspecialchars($compte->getType()->value) ?>
                                    </h3>
                                    <span class="bg-<?= $compte->getType()->value === 'principal' ? 'blue' : 'green' ?>-100 text-<?= $compte->getType()->value === 'principal' ? 'blue' : 'green' ?>-800 text-xs font-medium px-2 py-1 rounded-full">
                                        <?= ucfirst($compte->getType()->value) ?>
                                    </span>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Solde:</span>
                                        <span class="font-bold text-xl text-orange-600">
                                            <?= number_format($compte->getMontant(), 0, ',', ' ') ?> FCFA
                                        </span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Téléphone:</span>
                                        <span class="font-medium"><?= htmlspecialchars($compte->getNumeroTel()) ?></span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">CNI:</span>
                                        <span class="font-medium"><?= htmlspecialchars($compte->getNumeroCNI()) ?></span>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex space-x-2">
                                    <button class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-colors text-sm">
                                        Dépôt
                                    </button>
                                    <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors text-sm">
                                        Retrait
                                    </button>
                                    <button class="flex-1 bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-lg transition-colors text-sm">
                                        Transfert
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>