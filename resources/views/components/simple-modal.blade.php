@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));

switch ($maxWidth ?? '2xl') {
    case 'sm':
        $maxWidth = 'sm:max-w-sm';
        break;
    case 'md':
        $maxWidth = 'sm:max-w-md';
        break;
    case 'lg':
        $maxWidth = 'sm:max-w-lg';
        break;
    case 'xl':
        $maxWidth = 'sm:max-w-xl';
        break;
    case '2xl':
    default:
        $maxWidth = 'sm:max-w-2xl';
        break;
    case '3xl':
        $maxWidth = 'sm:max-w-3xl';
        break;
    case '4xl':
        $maxWidth = 'sm:max-w-4xl';
        break;
    case '5xl':
        $maxWidth = 'sm:max-w-5xl';
        break;
    case '6xl':
        $maxWidth = 'sm:max-w-6xl';
        break;
    case '7xl':
        $maxWidth = 'sm:max-w-7xl';
        break;
}
@endphp

<div id="{{ $id }}" class="modal fixed inset-0 z-50 hidden">
    <!-- Modal backdrop -->
    <div class="modal-backdrop fixed inset-0 bg-gray-500 bg-opacity-75"></div>
    
    <!-- Modal content -->
    <div class="modal-container fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="modal-content relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full {{ $maxWidth }} sm:mx-auto">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour ouvrir un modal
        window.openSimpleModal = function(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                
                // Ajouter des gestionnaires d'événements pour fermer le modal
                const backdrop = modal.querySelector('.modal-backdrop');
                backdrop.addEventListener('click', function() {
                    closeSimpleModal(modalId);
                });
                
                // Empêcher la propagation des clics sur le contenu du modal
                const content = modal.querySelector('.modal-content');
                content.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Activer tous les champs de formulaire
                setTimeout(function() {
                    const inputs = modal.querySelectorAll('input, textarea, select');
                    inputs.forEach(function(input) {
                        input.disabled = false;
                        if (input.tagName === 'TEXTAREA' || input.type === 'text') {
                            input.focus();
                            input.blur();
                        }
                    });
                    
                    // Focus sur le premier champ
                    const firstInput = modal.querySelector('input:not([type="hidden"]), textarea, select');
                    if (firstInput) {
                        firstInput.focus();
                    }
                }, 100);
                
                // Ajouter un gestionnaire d'événement pour la touche Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeSimpleModal(modalId);
                    }
                });
            }
        };
        
        // Fonction pour fermer un modal
        window.closeSimpleModal = function(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
            }
        };
        
        // Initialiser les boutons de fermeture
        document.querySelectorAll('[data-dismiss="modal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                if (modal) {
                    closeSimpleModal(modal.id);
                }
            });
        });
    });
</script>
