<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">DevsAI</a>
            
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Connexion</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Inscription</a>
            </div>
        </div>
    </div>
</nav>
