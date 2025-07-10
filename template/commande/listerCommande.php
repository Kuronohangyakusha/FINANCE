 
<body class="bg-dark-green text-white min-h-screen">
 
    <main class="container mx-auto px-6 py-8">
         
        <h2 class="text-3xl font-bold mb-8">Liste des commandes</h2>

 
        <div class="flex space-x-4 mb-8">
            <div class="relative">
                <select class="bg-light-gray border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-green-accent">
                    <option>Filtrer par statut</option>
                    <option>Payé</option>
                    <option>Impayé</option>
                </select>
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">∨</span>
            </div>
            <div class="relative">
                <select class="bg-light-gray border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-green-accent">
                    <option>Filtrer par client</option>
                </select>
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">∨</span>
            </div>
            <div class="relative">
                <select class="bg-light-gray border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-green-accent">
                    <option>Filtrer par Etat</option>
                </select>
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">∨</span>
               
            </div>
            
        </div>

        <!-- Orders Table -->
        <div class="bg-light-gray rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="pb-4 font-medium text-gray-300">Numero Commande</th>
                            <th class="pb-4 font-medium text-gray-300">Client</th>
                            <th class="pb-4 font-medium text-gray-300">Status</th>
                            <th class="pb-4 font-medium text-gray-300">Facture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 font-medium">#COM_001</td>
                            <td class="py-4 text-gray-300">BAKARY DIASSY</td>
                            <td class="py-4">
                                <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">impayé</span>
                            </td>
                            <td class="py-4">
                                <a href="App.php?page=voir-detail-commande" class="bg-green-accent text-black px-4 py-2 rounded-lg font-semibold hover:bg-green-500">
                                    voir
                                </a>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 font-medium">#COM_002</td>
                            <td class="py-4 text-gray-300">ANONYME</td>
                            <td class="py-4">
                                <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-sm">impayé</span>
                            </td>
                            <td class="py-4">
                                <a href="App.php?page=voir-detail-commande" class="bg-green-accent text-black px-4 py-2 rounded-lg font-semibold hover:bg-green-500">
                                    voir
                                </a>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="py-4 font-medium">#COM_003</td>
                            <td class="py-4 text-gray-300">ALI DIOP</td>
                            <td class="py-4">
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">payé</span>
                            </td>
                            <td class="py-4">
                                <a href="App.php?page=voir-detail-commande" class="bg-green-accent text-black px-4 py-2 rounded-lg font-semibold hover:bg-green-500">
                                    voir
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center items-center space-x-2 mt-8">
                <button class="p-2 text-gray-400 hover:text-white">‹</button>
                <button class="w-8 h-8 bg-green-accent text-black rounded-full font-semibold">1</button>
                <button class="w-8 h-8 text-gray-400 hover:text-white">2</button>
                <button class="w-8 h-8 text-gray-400 hover:text-white">3</button>
                <button class="p-2 text-gray-400 hover:text-white">›</button>
            </div>
        </div>
    </main>
</body>
 