<div class="bg-gradient-to-b from-indigo-900 to-indigo-800 text-white w-64 py-6 flex-shrink-0 hidden md:block">
    <div class="px-6">
        <div class="flex items-center mb-8">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold">DevsAI</h2>
        </div>

        <div class="mb-8">
            <div class="text-xs uppercase text-indigo-300 font-semibold tracking-wider mb-3">
                Menu principal
            </div>
            <nav>
                <ul class="space-y-2">
                    <!-- Éléments supprimés selon la demande de l'utilisateur -->
                </ul>
            </nav>
        </div>

        <div class="pt-6 mt-6 border-t border-indigo-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full py-2.5 px-4 rounded-lg text-indigo-100 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile sidebar toggle -->
<div class="md:hidden fixed bottom-4 right-4 z-50">
    <button id="sidebarToggle" class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white p-3 rounded-full shadow-lg">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<!-- Mobile sidebar -->
<div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-40 hidden">
    <div class="bg-gradient-to-b from-indigo-900 to-indigo-800 text-white w-72 min-h-screen py-6 transform -translate-x-full transition-transform duration-300" id="sidebarContent">
        <div class="px-6">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold">DevsAI</h2>
                </div>
                <button id="closeSidebar" class="text-white p-2 rounded-lg hover:bg-white hover:bg-opacity-10">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="mb-8">
                <div class="text-xs uppercase text-indigo-300 font-semibold tracking-wider mb-3">
                    Menu principal
                </div>
                <nav>
                    <ul class="space-y-2">
                        <!-- Éléments supprimés selon la demande de l'utilisateur -->
                    </ul>
                </nav>
            </div>

            <div class="pt-6 mt-6 border-t border-indigo-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full py-2.5 px-4 rounded-lg text-indigo-100 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const sidebarContent = document.getElementById('sidebarContent');
        const closeSidebar = document.getElementById('closeSidebar');

        sidebarToggle.addEventListener('click', function() {
            mobileSidebar.classList.remove('hidden');
            setTimeout(() => {
                sidebarContent.classList.remove('-translate-x-full');
            }, 50);
        });

        closeSidebar.addEventListener('click', function() {
            sidebarContent.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileSidebar.classList.add('hidden');
            }, 300);
        });

        mobileSidebar.addEventListener('click', function(e) {
            if (e.target === mobileSidebar) {
                sidebarContent.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileSidebar.classList.add('hidden');
                }, 300);
            }
        });
    });
</script>
@endpush
