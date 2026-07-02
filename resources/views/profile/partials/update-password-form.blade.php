<style>
    /* ============================================
       UPDATE PASSWORD SECTION - LIGHT & DARK MODE
       ============================================ */
    
    /* Base Styles */
    .update-password-section {
        space-y: 1.5rem;
    }
    
    .update-password-header h2 {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
        transition: color 0.3s ease;
    }
    
    .update-password-header p {
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #4b5563;
        transition: color 0.3s ease;
    }
    
    /* Form Styles */
    .password-form {
        margin-top: 1.5rem;
        space-y: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
        transition: color 0.3s ease;
    }
    
    .form-group input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        color: #111827;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .form-group input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    
    .form-group .input-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }
    
    /* Primary Button */
    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: #3b82f6;
        color: #ffffff;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-primary-custom:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }
    
    .btn-primary-custom:active {
        transform: translateY(0);
    }
    
    /* Success Message */
    .success-message {
        color: #059669;
        font-size: 0.875rem;
        animation: fadeInOut 2s ease forwards;
    }
    
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(-10px); }
        20% { opacity: 1; transform: translateY(0); }
        80% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(-10px); }
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    /* ============================================
       DARK MODE STYLES
       ============================================ */
    .dark .update-password-header h2 {
        color: #ffffff;
    }
    
    .dark .update-password-header p {
        color: #9ca3af;
    }
    
    .dark .form-group label {
        color: #d1d5db;
    }
    
    .dark .form-group input {
        background: #1f2937;
        border-color: #374151;
        color: #f3f4f6;
    }
    
    .dark .form-group input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    
    .dark .form-group input::placeholder {
        color: #6b7280;
    }
    
    .dark .form-group .input-error {
        color: #f87171;
    }
    
    .dark .btn-primary-custom {
        background: #3b82f6;
    }
    
    .dark .btn-primary-custom:hover {
        background: #2563eb;
    }
    
    .dark .success-message {
        color: #34d399;
    }
    
    /* ============================================
       RESPONSIVE STYLES
       ============================================ */
    @media (max-width: 640px) {
        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .form-actions .btn-primary-custom {
            justify-content: center;
        }
        
        .form-actions .success-message {
            text-align: center;
        }
    }
</style>

<section class="update-password-section">
    <header class="update-password-header">
        <h2>
            {{ __('Update Password') }}
        </h2>

        <p>
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="password-form">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="form-group">
            <label for="update_password_current_password">
                {{ __('Current Password') }}
            </label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                autocomplete="current-password"
                placeholder="Enter your current password"
            />
            @error('current_password', 'updatePassword')
                <p class="input-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="update_password_password">
                {{ __('New Password') }}
            </label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                autocomplete="new-password"
                placeholder="Enter new password"
            />
            @error('password', 'updatePassword')
                <p class="input-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="update_password_password_confirmation">
                {{ __('Confirm Password') }}
            </label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                autocomplete="new-password"
                placeholder="Confirm new password"
            />
            @error('password_confirmation', 'updatePassword')
                <p class="input-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-primary-custom">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="success-message"
                >
                    ✅ {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>