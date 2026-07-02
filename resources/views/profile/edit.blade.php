<style>
    /* ============================================
       DELETE ACCOUNT SECTION - COMPLETE
       LIGHT & DARK MODE WITH INTERACTIVE FEATURES
       ============================================ */
    
    /* ===== BASE STYLES ===== */
    .delete-account-section {
        max-width: 100%;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
        transition: border-color 0.3s ease;
    }
    
    .delete-account-header {
        margin-bottom: 1.5rem;
    }
    
    .delete-account-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
        transition: color 0.3s ease;
    }
    
    .delete-account-header p {
        font-size: 0.875rem;
        color: #6b7280;
        transition: color 0.3s ease;
    }
    
    /* ===== DANGER BUTTON ===== */
    .btn-danger-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.25rem;
        background: #dc2626;
        color: #ffffff;
        border: none;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        gap: 0.5rem;
    }
    
    .btn-danger-custom:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
    }
    
    .btn-danger-custom:active {
        transform: translateY(0);
    }
    
    /* ===== MODAL STYLES ===== */
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
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1) translateY(0);
    }
    
    .modal-content .modal-icon {
        text-align: center;
        font-size: 3rem;
        margin-bottom: 0.5rem;
    }
    
    .modal-content h2 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    
    .modal-content p {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
        text-align: center;
        line-height: 1.6;
    }
    
    .modal-content .form-group {
        margin-bottom: 1.25rem;
    }
    
    .modal-content .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.375rem;
        transition: color 0.3s ease;
    }
    
    .modal-content .input-wrapper {
        position: relative;
    }
    
    .modal-content input {
        width: 100%;
        padding: 0.625rem 0.875rem;
        padding-right: 2.5rem;
        background: #ffffff;
        border: 1.5px solid #d1d5db;
        border-radius: 0.5rem;
        color: #111827;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }
    
    .modal-content input:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
    }
    
    .modal-content input.error {
        border-color: #dc2626;
    }
    
    .modal-content input.error:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
    }
    
    /* Toggle Password Button */
    .modal-content .toggle-password {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #9ca3af;
        font-size: 1.125rem;
        padding: 0.25rem;
        transition: color 0.2s ease;
    }
    
    .modal-content .toggle-password:hover {
        color: #6b7280;
    }
    
    .modal-content .input-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    /* ===== MODAL BUTTONS ===== */
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    
    .btn-secondary-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.25rem;
        background: #e5e7eb;
        color: #111827;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        gap: 0.5rem;
    }
    
    .btn-secondary-custom:hover {
        background: #d1d5db;
        transform: translateY(-1px);
    }
    
    .btn-secondary-custom:active {
        transform: translateY(0);
    }
    
    .btn-danger-custom-modal {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.25rem;
        background: #dc2626;
        color: #ffffff;
        border: none;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        gap: 0.5rem;
    }
    
    .btn-danger-custom-modal:hover {
        background: #b91c1c;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
    }
    
    .btn-danger-custom-modal:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
    }
    
    /* ============================================
       DARK MODE STYLES
       ============================================ */
    .dark .delete-account-section {
        border-top-color: #374151;
    }
    
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
    
    .dark .modal-content {
        background: #1f2937;
    }
    
    .dark .modal-content h2 {
        color: #ffffff;
    }
    
    .dark .modal-content p {
        color: #9ca3af;
    }
    
    .dark .modal-content .form-group label {
        color: #d1d5db;
    }
    
    .dark .modal-content input {
        background: #111827;
        border-color: #374151;
        color: #f3f4f6;
    }
    
    .dark .modal-content input:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    
    .dark .modal-content input::placeholder {
        color: #6b7280;
    }
    
    .dark .modal-content input.error {
        border-color: #ef4444;
    }
    
    .dark .modal-content input.error:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    
    .dark .modal-content .toggle-password {
        color: #6b7280;
    }
    
    .dark .modal-content .toggle-password:hover {
        color: #9ca3af;
    }
    
    .dark .modal-content .input-error {
        color: #f87171;
    }
    
    .dark .btn-secondary-custom {
        background: #374151;
        color: #f3f4f6;
        border-color: #4b5563;
    }
    
    .dark .btn-secondary-custom:hover {
        background: #4b5563;
    }
    
    .dark .btn-danger-custom-modal {
        background: #dc2626;
    }
    
    .dark .btn-danger-custom-modal:hover {
        background: #b91c1c;
    }
    
    /* ============================================
       RESPONSIVE STYLES
       ============================================ */
    @media (max-width: 640px) {
        .modal-content {
            width: 95%;
            padding: 1.25rem;
        }
        
        .modal-actions {
            flex-direction: column-reverse;
        }
        
        .modal-actions button {
            width: 100%;
            justify-content: center;
        }
        
        .delete-account-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }
    }
    
    /* ============================================
       ANIMATIONS
       ============================================ */
    @keyframes modalSlideIn {
        from {
            transform: scale(0.9) translateY(20px);
            opacity: 0;
        }
        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }
    
    .modal-overlay.active .modal-content {
        animation: modalSlideIn 0.3s ease forwards;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .modal-content input.error {
        animation: shake 0.3s ease;
    }
</style>

<section class="delete-account-section" x-data="deleteAccountManager()">
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
        @click="openModal()"
    >
        <span>🗑️</span> {{ __('Delete Account') }}
    </button>

    <!-- Modal -->
    <div id="deleteModal" class="modal-overlay" 
         :class="{ 'active': showModal }" 
         @click.away="closeModal()"
         @keydown.escape="closeModal()">
        
        <div class="modal-content" @click.stop>
            <form method="post" action="{{ route('profile.destroy') }}" 
                  @submit.prevent="confirmDelete($el)">
                @csrf
                @method('delete')

                <!-- Modal Icon -->
                <div class="modal-icon">⚠️</div>

                <h2>
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="form-group">
                    <label for="password">
                        {{ __('Password') }}
                    </label>
                    <div class="input-wrapper">
                        <input 
                            id="password"
                            name="password"
                            :type="showPassword ? 'text' : 'password'"
                            placeholder="Enter your password to confirm"
                            x-model="password"
                            @input="validatePassword(password)"
                            :class="{ 'error': passwordError }"
                            required
                        />
                        <button type="button" class="toggle-password" @click="showPassword = !showPassword">
                            <span x-text="showPassword ? '👁️' : '👁️‍🗨️'"></span>
                        </button>
                    </div>
                    <p x-show="passwordError" class="input-error">
                        ❌ Please enter your password
                    </p>
                    @error('password', 'userDeletion')
                        <p class="input-error">❌ {{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button 
                        type="button" 
                        class="btn-secondary-custom"
                        @click="closeModal()"
                    >
                        <span>✖️</span> {{ __('Cancel') }}
                    </button>

                    <button type="submit" class="btn-danger-custom-modal" 
                            :disabled="!isFormValid()">
                        <span>🗑️</span> {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function deleteAccountManager() {
        return {
            showModal: false,
            password: '',
            showPassword: false,
            passwordError: false,
            
            openModal() {
                this.showModal = true;
                this.password = '';
                this.passwordError = false;
                document.body.style.overflow = 'hidden';
                // Focus the password input after modal opens
                setTimeout(() => {
                    const input = document.getElementById('password');
                    if (input) input.focus();
                }, 300);
            },
            
            closeModal() {
                this.showModal = false;
                document.body.style.overflow = '';
                this.password = '';
                this.passwordError = false;
            },
            
            validatePassword(password) {
                this.passwordError = password.length === 0;
            },
            
            isFormValid() {
                return this.password.length > 0;
            },
            
            confirmDelete(form) {
                if (!this.isFormValid()) {
                    this.passwordError = true;
                    return;
                }
                
                if (confirm('⚠️ Are you absolutely sure you want to delete your account? This action cannot be undone!')) {
                    form.submit();
                }
            }
        };
    }
</script>