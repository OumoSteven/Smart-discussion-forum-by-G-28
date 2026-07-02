<style>
    /* ============================================
       DELETE ACCOUNT SECTION - LIGHT & DARK MODE
       ============================================ */
    
    /* Base Styles */
    .delete-account-section {
        space-y: 1.5rem;
    }
    
    .delete-account-header h2 {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
        transition: color 0.3s ease;
    }
    
    .delete-account-header p {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #4b5563;
        transition: color 0.3s ease;
    }
    
    /* Danger Button */
    .btn-danger-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: #dc2626;
        color: #ffffff;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-danger-custom:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
    }
    
    .btn-danger-custom:active {
        transform: translateY(0);
    }
    
    /* Secondary Button */
    .btn-secondary-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: #e5e7eb;
        color: #111827;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-secondary-custom:hover {
        background: #d1d5db;
        transform: translateY(-1px);
    }
    
    .btn-secondary-custom:active {
        transform: translateY(0);
    }
    
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-content {
        background: #ffffff;
        border-radius: 0.75rem;
        max-width: 448px;
        width: 90%;
        padding: 1.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transform: scale(0.9) translateY(20px);
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1) translateY(0);
    }
    
    .modal-content h2 {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    
    .modal-content p {
        font-size: 0.875rem;
        color: #4b5563;
        margin-bottom: 1.5rem;
    }
    
    .modal-content .form-group {
        margin-bottom: 1.5rem;
    }
    
    .modal-content input {
        width: 75%;
        padding: 0.5rem 0.75rem;
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        color: #111827;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .modal-content input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    
    .modal-content .input-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }
    
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    
    /* ============================================
       DARK MODE STYLES
       ============================================ */
    .dark .delete-account-header h2 {
        color: #ffffff;
    }
    
    .dark .delete-account-header p {
        color: #9ca3af;
    }
    
    .dark .btn-danger-custom {
        background: #dc2626;
    }
    
    .dark .btn-danger-custom:hover {
        background: #b91c1c;
    }
    
    .dark .btn-secondary-custom {
        background: #374151;
        color: #f3f4f6;
        border-color: #4b5563;
    }
    
    .dark .btn-secondary-custom:hover {
        background: #4b5563;
    }
    
    .dark .modal-content {
        background: #1f2937;
    }
    
    .dark .modal-content h2 {
        color: #ffffff;
    }
    
    .dark .modal-content p {
        color: #9ca3af;
    }
    
    .dark .modal-content input {
        background: #111827;
        border-color: #374151;
        color: #f3f4f6;
    }
    
    .dark .modal-content input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    
    .dark .modal-content .input-error {
        color: #f87171;
    }
    
    /* ============================================
       RESPONSIVE STYLES
       ============================================ */
    @media (max-width: 640px) {
        .modal-content {
            width: 95%;
            padding: 1rem;
        }
        
        .modal-content input {
            width: 100%;
        }
        
        .modal-actions {
            flex-direction: column-reverse;
        }
        
        .modal-actions button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<section class="delete-account-section space-y-6">
    <header class="delete-account-header">
        <h2>
            {{ __('Delete Account') }}
        </h2>

        <p>
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Button -->
    <button 
        class="btn-danger-custom"
        onclick="document.getElementById('deleteModal').classList.add('active')"
    >
        {{ __('Delete Account') }}
    </button>

    <!-- Modal -->
    <div id="deleteModal" class="modal-overlay" onclick="if(event.target === this) this.classList.remove('active')">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2>
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="form-group">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="{{ __('Password') }}"
                    />
                    @error('password', 'userDeletion')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button 
                        type="button" 
                        class="btn-secondary-custom"
                        onclick="document.getElementById('deleteModal').classList.remove('active')"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="btn-danger-custom">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>