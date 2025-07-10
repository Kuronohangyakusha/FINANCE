<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4 overflow-hidden">
    <div class="w-full h-full max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row h-full">
            <!-- Section gauche - Illustration -->
            <div class="lg:w-1/2 bg-gradient-to-br from-orange-400 to-orange-600 p-8 flex items-center justify-center">
                <div class="text-center">
                    <!-- Illustration stylisée -->
                    <div class="relative mb-8">
                        <!-- Téléphone -->
                        <div class="bg-gray-900 rounded-3xl p-4 w-64 h-96 mx-auto shadow-2xl">
                            <div class="bg-white rounded-2xl h-full p-4">
                                <!-- Header du téléphone -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-6 h-6 bg-orange-500 rounded"></div>
                                    <div class="text-xs font-medium">Profil</div>
                                    <div class="w-6 h-6 bg-gray-300 rounded"></div>
                                </div>
                                
                                <!-- Contenu du téléphone -->
                                <div class="space-y-3">
                                    <div class="bg-gray-100 rounded-lg p-3">
                                        <div class="w-full h-16 bg-blue-200 rounded mb-2"></div>
                                        <div class="h-2 bg-gray-300 rounded w-3/4"></div>
                                        <div class="h-2 bg-gray-300 rounded w-1/2 mt-1"></div>
                                    </div>
                                    
                                    <div class="bg-gray-100 rounded-lg p-3">
                                        <div class="h-2 bg-gray-300 rounded w-full"></div>
                                        <div class="h-2 bg-gray-300 rounded w-2/3 mt-1"></div>
                                    </div>
                                    
                                    <div class="bg-orange-500 text-white rounded-lg p-3 text-center">
                                        <div class="text-sm font-bold">$29.99</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personnage -->
                        <div class="absolute -bottom-4 -left-8">
                            <div class="w-20 h-20 bg-gray-800 rounded-full"></div>
                            <div class="w-16 h-24 bg-orange-500 rounded-t-full mx-auto -mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section droite - Formulaire -->
            <div class="lg:w-1/2 p-4 overflow-y-auto">
                <div class="max-w-md mx-auto h-full flex flex-col justify-center">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Création Compte</h1>
                        <p class="text-gray-600">Créez votre compte pour commencer</p>
                    </div>
                    
                    <!-- Formulaire -->
                    <form class="space-y-4">
                        <!-- Nom et Prénom -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NOM</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors">
                            </div>
                        </div>
                        
                        <!-- Photos -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                                <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center hover:border-orange-400 transition-colors cursor-pointer">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        <p class="text-sm text-gray-500">Ajouter</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                                <div class="w-full h-24 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center hover:border-orange-400 transition-colors cursor-pointer">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        <p class="text-sm text-gray-500">Ajouter</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Adresse -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors">
                        </div>
                        
                        <!-- Téléphone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors">
                        </div>
                        
                        <!-- CNI -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CNI</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-colors">
                        </div>
                        
                        <!-- Bouton -->
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 outline-none">
                            Créer compte
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>