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

<div
    x-data="{ show: false }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    id="{{ $id }}"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
    @click.away="show = false"
>
    <div x-show="show"  @click.self="show = false" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div x-show="show" class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        @click.stop
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>

<script>
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            // Utiliser Alpine.evaluate pour définir show = true
            Alpine.evaluate(modal, 'show = true');

            // S'assurer que les champs de formulaire sont activés et peuvent recevoir des entrées
            setTimeout(() => {
                const formInputs = modal.querySelectorAll('input, textarea, select');
                formInputs.forEach(input => {
                    // Empêcher la propagation des événements pour éviter que le modal ne les capture
                    input.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                    
                    input.addEventListener('keydown', function(e) {
                        e.stopPropagation();
                    });
                    
                    // Réinitialiser les champs si nécessaire
                    if (input.type === 'text' || input.tagName === 'TEXTAREA') {
                        // Forcer un focus puis blur pour s'assurer que le champ est activé
                        input.focus();
                        input.blur();
                    }
                });

                // Activer le premier champ de l'étape active
                const activeStep = modal.querySelector('.step-content.active');
                if (activeStep) {
                    const firstInput = activeStep.querySelector('input, textarea, select');
                    if (firstInput) {
                        firstInput.focus();
                    }
                }
            }, 100); // Petit délai pour s'assurer que le modal est complètement affiché
        }
    }

    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            Alpine.evaluate(modal, 'show = false');
        }
    }
</script>
