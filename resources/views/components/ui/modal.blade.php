@props([
    'id' => null,
    'title' => null,
    'size' => 'md',
    'closeable' => true
])

@php
$modalId = $id ?? 'modal-' . uniqid();
$sizes = [
    'sm' => 'max-w-md',
    'md' => 'max-w-lg',
    'lg' => 'max-w-2xl',
    'xl' => 'max-w-4xl',
    '2xl' => 'max-w-6xl'
];
@endphp

<div 
    id="{{ $modalId }}" 
    class="fixed inset-0 z-50 hidden overflow-y-auto"
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle {{ $sizes[$size] }} w-full">
            @if($title || $closeable)
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        @if($title)
                            <h3 class="text-lg leading-6 font-medium text-primary" id="modal-title">
                                {{ $title }}
                            </h3>
                        @endif
                        @if($closeable)
                            <button 
                                type="button" 
                                class="modal-close rounded-md text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-primary"
                                data-modal-close="{{ $modalId }}"
                            >
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('{{ $modalId }}');
    const closeButtons = document.querySelectorAll('[data-modal-close="{{ $modalId }}"]');
    
    // Close modal function
    function closeModal() {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Open modal function
    function openModal() {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    // Close button events
    closeButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });
    
    // Close on background click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
    
    // Expose functions globally
    window.openModal{{ $modalId }} = openModal;
    window.closeModal{{ $modalId }} = closeModal;
});
</script>
