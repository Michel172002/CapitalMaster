<!-- resources/views/components/notification.blade.php -->
<div x-data="{
    toasts: [],
    addToast(message, type = 'info', duration = 4000) {
        const id = 'toast-' + Math.random().toString(16).slice(2);
        this.toasts.unshift({
            id: id,
            message: message,
            type: type,
            show: false
        });
        
        // Auto remove after duration
        setTimeout(() => {
            this.removeToast(id);
        }, duration);
    },
    removeToast(id) {
        const index = this.toasts.findIndex(toast => toast.id === id);
        if (index > -1) {
            this.toasts.splice(index, 1);
        }
    }
}" 
x-init="
    // Listen for toast events
    window.addEventListener('toast', (event) => {
        addToast(event.detail.message, event.detail.type, event.detail.duration);
    });
    
    // Listen for success events
    window.addEventListener('toast-success', (event) => {
        addToast(event.detail.message || 'Sucesso!', 'success', event.detail.duration);
    });
    
    // Listen for error events
    window.addEventListener('toast-error', (event) => {
        addToast(event.detail.message || 'Erro!', 'danger', event.detail.duration);
    });
    
    // Listen for warning events
    window.addEventListener('toast-warning', (event) => {
        addToast(event.detail.message || 'Atenção!', 'warning', event.detail.duration);
    });
    
    // Listen for info events
    window.addEventListener('toast-info', (event) => {
        addToast(event.detail.message || 'Informação', 'info', event.detail.duration);
    });
"
class="fixed top-4 right-4 z-50 space-y-2">
    
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-data="{ show: false }"
            x-init="
                setTimeout(() => show = true, 100);
                setTimeout(() => show = false, 3500);
                setTimeout(() => $parent.removeToast(toast.id), 4000);
            "
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            class="bg-white border border-gray-200 rounded-lg shadow-lg p-4 max-w-sm w-full"
        >
            <div class="flex items-start">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <!-- Success Icon -->
                    <svg x-show="toast.type === 'success'" class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    
                    <!-- Error Icon -->
                    <svg x-show="toast.type === 'danger'" class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    
                    <!-- Warning Icon -->
                    <svg x-show="toast.type === 'warning'" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    
                    <!-- Info Icon -->
                    <svg x-show="toast.type === 'info'" class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                
                <!-- Content -->
                <div class="ml-3 flex-1">
                    <p class="text-xs font-medium text-gray-500" x-text="toast.message"></p>
                </div>
                
                <!-- Close Button -->
                <div class="ml-4 flex-shrink-0">
                    <button 
                        @click="$parent.removeToast(toast.id)"
                        class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
