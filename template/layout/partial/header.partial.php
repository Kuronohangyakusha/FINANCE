<div class="sidebar w-64 bg-white shadow-lg flex flex-col fixed md:relative h-full z-20 md:z-auto">
    <!-- Header avec profil -->
    <div class="p-4 md:p-6 border-b flex-shrink-0">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-500 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-base md:text-lg">
                        <?= strtoupper(substr($user['prenom'] ?? 'U', 0, 1)) ?>
                    </span>
                </div>
                <div>
                    <p class="font-medium text-gray-900 text-sm md:text-base">
                        <?= htmlspecialchars(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? '')) ?>
                    </p>
                    <p class="text-xs text-gray-500"><?= htmlspecialchars($user['numero_tel'] ?? '') ?></p>
                </div>
            </div>
            <!-- Bouton fermer pour mobile -->
            <label for="menu-toggle" class="md:hidden cursor-pointer p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </label>
        </div>
    </div>
    
    <!-- Menu navigation -->
    <div class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="/dashboard" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 md:py-3 px-4 rounded-lg transition-colors text-left text-sm md:text-base block">
            Dashboard
        </a>
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 md:py-3 px-4 rounded-lg transition-colors text-left text-sm md:text-base">
            Créer compte
        </button>
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 md:py-3 px-4 rounded-lg transition-colors text-left text-sm md:text-base">
            Transaction
        </button>
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 md:py-3 px-4 rounded-lg transition-colors text-left text-sm md:text-base">
            Liste compte
        </button>
        <a href="/logout" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 md:py-3 px-4 rounded-lg transition-colors text-left text-sm md:text-base block">
            Déconnexion
        </a>
    </div>
    
    <!-- Illustration -->
    <div class="p-4 flex-shrink-0 hidden md:block">
        <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg p-4 relative overflow-hidden">
            <div class="relative z-10">
                <div class="bg-gray-900 rounded-2xl p-2 w-20 h-28 mx-auto shadow-lg">
                    <div class="bg-white rounded-xl h-full p-2">
                        <div class="space-y-1">
                            <div class="bg-gray-100 rounded p-1">
                                <div class="w-full h-3 bg-blue-200 rounded mb-1"></div>
                                <div class="h-1 bg-gray-300 rounded w-3/4"></div>
                            </div>
                            <div class="bg-orange-500 text-white rounded p-1 text-center">
                                <div class="text-xs font-bold">7500</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Personnage stylisé -->
            <div class="absolute -bottom-2 -left-2">
                <div class="w-8 h-8 bg-gray-800 rounded-full"></div>
                <div class="w-6 h-10 bg-orange-500 rounded-t-full mx-auto -mt-1"></div>
            </div>
        </div>
    </div>
    
    <!-- Solde compte -->
    <div class="p-4 border-t flex-shrink-0">
        <div class="bg-orange-500 text-white rounded-lg p-3 md:p-4 text-center">
            <p class="text-xs md:text-sm font-medium">Solde Compte</p>
            <p class="text-xl md:text-2xl font-bold">7,500 FCFA</p>
        </div>
    </div>
</div>