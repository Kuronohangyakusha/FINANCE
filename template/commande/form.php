 
<body class="bg-dark-green text-white min-h-screen">
   
  

   
    <main class="container mx-auto px-20 py-8">
 
        <h2 class="text-3xl font-bold mb-8">Nouveau Commande</h2>

        
      <div class="space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white font-medium mb-2">Client</label>
                    <div class="relative">
                        <select class="w-full bg-light-gray border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-green-accent">
                            <option>Sélectionner client</option>
                        </select>
                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></span>
                    </div>
                </div>
                <div>
                    <label class="block text-white font-medium mb-2">Paiement</label>
                    <input type="text" placeholder="Entrer le montant" class="w-full bg-light-gray border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-green-accent">
                </div>
            </div>

           
            <div>
                <h3 class="text-xl font-semibold mb-8">Ajouter Produit</h3>
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-48">
                        <div class="relative">
                            <select class="w-full bg-light-gray border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-green-accent">
                                <option>Sélectionner un produit</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-1 min-w-32">
                        <input type="text" placeholder="Saisir le montant" class="w-full bg-light-gray border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-green-accent">
                    </div>
                    <button class="bg-green-accent text-black px-6 py-3 rounded-lg font-semibold hover:bg-green-500">
                        Ajouter
                    </button>
                </div>
            </div>

            
            <div class="bg-light-gray rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="pb-4 font-medium text-gray-300">Produits</th>
                                <th class="pb-4 font-medium text-gray-300">Quantité</th>
                                <th class="pb-4 font-medium text-gray-300">Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-700">
                                <td class="py-4">Sac de riz</td>
                                <td class="py-4">2</td>
                                <td class="py-4">60,000 fcfa</td>
                            </tr>
                            <tr class="border-b border-gray-700">
                                <td class="py-4">Sucre</td>
                                <td class="py-4">5</td>
                                <td class="py-4">200000 fcfa</td>
                            </tr>
                            <tr class="border-b border-gray-700">
                                <td class="py-4">Lait</td>
                                <td class="py-4">10</td>
                                <td class="py-4">1200 fcfa</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
               
                <div class="flex justify-center items-center space-x-2 mt-6">
                    <button class="p-2 text-gray-400 hover:text-white">‹</button>
                    <button class="w-8 h-8 bg-green-accent text-black rounded-full font-semibold">1</button>
                    <button class="w-8 h-8 text-gray-400 hover:text-white">2</button>
                    <button class="w-8 h-8 text-gray-400 hover:text-white">3</button>
                    <button class="p-2 text-gray-400 hover:text-white">›</button>
                </div>
            </div>

            
            <div class="flex justify-between items-center">
                <div class="text-xl font-semibold">
                    Total: 61,200 fcfa
                </div>
                <button class="bg-green-accent text-black px-8 py-3 rounded-lg font-semibold hover:bg-green-500">
                    Valider commande
                </button>
            </div>
        </div>
    </main>
</body>
 