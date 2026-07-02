<style>
    /* ============================================
       UPDATE PASSWORD SECTION - COMPLETE
       LIGHT & DARK MODE WITH INTERACTIVE FEATURES
       ============================================ */
    
    /* ===== BASE STYLES ===== */
    .update-password-section {
        max-width: 100%;
    }
    
    .update-password-header {
        margin-bottom: 1.5rem;
    }
    
    .update-password-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.25rem;
        transition: color 0.3s ease;
    }
    
    .update-password-header p {
        font-size: 0.875rem;
        color: #6b7280;
        transition: color 0.3s ease;
    }
    
    /* ===== FORM STYLES ===== */
    .password-form {
        margin-top: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.375rem;
        transition: color 0.3s ease;
    }
    
    .form-group .input-wrapper {
        position: relative;
    }
    
    .form-group input {
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
    
    .form-group input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }
    
    .form-group input.error {
        border-color: #dc2626;
    }
    
    .form-group input.error:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
    }
    
    .form-group input.success {
        border-color: #10b981;
    }
    
    .form-group input.success:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }
    
    /* Password Toggle Button */
    .toggle-password {
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
    
    .toggle-password:hover {
        color: #6b7280;
    }
    
    /* Validation Messages */
    .input-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .input-success {
        color: #10b981;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    /* Password Strength Indicator */
    .password-strength {
        margin-top: 0.5rem;
    }
    
    .strength-bars {
        display: flex;
        gap: 0.25rem;
        margin-bottom: 0.25rem;
    }
    
    .strength-bar {
        height: 4px;
        flex: 1;
        border-radius: 4px;
        background: #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .strength-bar.active.weak {
        background: #ef4444;
    }
    
    .strength-bar.active.medium {
        background: #f59e0b;
    }
    
    .strength-bar.active.strong {
        background: #10b981;
    }
    
    .strength-text {
        font-size: 0.7rem;
        color: #6b7280;
        margin: 0;
    }
    
    .strength-text.weak { color: #ef4444; }
    .strength-text.medium { color: #f59e0b; }
    .strength-text.strong { color: #10b981; }
    
    /* Password Requirements */
    .password-requirements {
        margin-top: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .requirement {
        font-size: 0.7rem;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        transition: all 0.3s ease;
    }
    
    .requirement.met {
        color: #10b981;
    }
    
    .requirement .icon {
        font-size: 0.75rem;
    }
    
    /* ===== BUTTONS ===== */
    .btn-primary-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.25rem;
        background: #3b82f6;
        color: #ffffff;
        border: none;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        gap: 0.5rem;
    }
    
    .btn-primary-custom:hover {
        background: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }
    
    .btn-primary-custom:active {
        transform: translateY(0);
    }
    
    .btn-primary-custom:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
    }
    
    /* ===== SUCCESS MESSAGE ===== */
    .success-message {
        color: #10b981;
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.375rem;
        animation: slideIn 0.3s ease forwards;
    }
    
    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-10px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    
    /* ===== FORM ACTIONS ===== */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
        transition: border-color 0.3s ease;
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
    
    .dark .form-group input.error {
        border-color: #ef4444;
    }
    
    .dark .form-group input.error:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    
    .dark .form-group input.success {
        border-color: #34d399;
    }
    
    .dark .form-group input.success:focus {
        border-color: #34d399;
        box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.2);
    }
    
    .dark .input-error {
        color: #f87171;
    }
    
    .dark .input-success {
        color: #34d399;
    }
    
    .dark .toggle-password {
        color: #6b7280;
    }
    
    .dark .toggle-password:hover {
        color: #9ca3af;
    }
    
    .dark .strength-bar {
        background: #374151;
    }
    
    .dark .strength-bar.active.weak {
        background: #ef4444;
    }
    
    .dark .strength-bar.active.medium {
        background: #f59e0b;
    }
    
    .dark .strength-bar.active.strong {
        background: #34d399;
    }
    
    .dark .strength-text {
        color: #9ca3af;
    }
    
    .dark .strength-text.weak { color: #f87171; }
    .dark .strength-text.medium { color: #fbbf24; }
    .dark .strength-text.strong { color: #34d399; }
    
    .dark .requirement {
        color: #6b7280;
    }
    
    .dark .requirement.met {
        color: #34d399;
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
    
    .dark .form-actions {
        border-top-color: #374151;
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
            justify-content: center;
        }
        
        .password-requirements {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
</style>

<section class="update-password-section" x-data="passwordManager()">
    <header class="update-password-header">
        <h2>
            {{ __('Update Password') }}
        </h2>

        <p>
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="password-form" @submit.prevent="$el.submit()">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="form-group">
            <label for="update_password_current_password">
                {{ __('Current Password') }}
            </label>
            <div class="input-wrapper">
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    :type="showCurrentPassword ? 'text' : 'password'" 
                    autocomplete="current-password"
                    placeholder="Enter your current password"
                    x-model="currentPassword"
                />
                <button type="button" class="toggle-password" @click="showCurrentPassword = !showCurrentPassword">
                    <span x-text="showCurrentPassword ? '👁️' : '👁️‍🗨️'"></span>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <p class="input-error">❌ {{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="update_password_password">
                {{ __('New Password') }}
            </label>
            <div class="input-wrapper">
                <input 
                    id="update_password_password" 
                    name="password" 
                    :type="showNewPassword ? 'text' : 'password'" 
                    autocomplete="new-password"
                    placeholder="Enter new password"
                    x-model="newPassword"
                    @input="checkPasswordStrength(newPassword)"
                    :class="{
                        'error': newPassword && newPassword.length < 6,
                        'success': newPassword && newPassword.length >= 10
                    }"
                />
                <button type="button" class="toggle-password" @click="showNewPassword = !showNewPassword">
                    <span x-text="showNewPassword ? '👁️' : '👁️‍🗨️'"></span>
                </button>
            </div>
            
            <!-- Password Strength Indicator -->
            <div x-show="newPassword" class="password-strength">
                <div class="strength-bars">
                    <div class="strength-bar" 
                         :class="{ 'active weak': strength === 'weak' || strength === 'medium' || strength === 'strong' }">
                    </div>
                    <div class="strength-bar" 
                         :class="{ 'active medium': strength === 'medium' || strength === 'strong' }">
                    </div>
                    <div class="strength-bar" 
                         :class="{ 'active strong': strength === 'strong' }">
                    </div>
                </div>
                <p class="strength-text" :class="strength">
                    <span x-show="strength === 'weak'">🔴 Weak</span>
                    <span x-show="strength === 'medium'">🟡 Medium</span>
                    <span x-show="strength === 'strong'">🟢 Strong</span>
                    <span x-show="strength"> ({{ newPassword.length }} characters)</span>
                </p>
            </div>
            
            <!-- Password Requirements -->
            <div class="password-requirements">
                <span class="requirement" :class="{ 'met': newPassword.length >= 8 }">
                    <span class="icon" x-text="newPassword.length >= 8 ? '✅' : '❌'"></span>
                    At least 8 characters
                </span>
                <span class="requirement" :class="{ 'met': hasUppercase }">
                    <span class="icon" x-text="hasUppercase ? '✅' : '❌'"></span>
                    One uppercase letter
                </span>
                <span class="requirement" :class="{ 'met': hasLowercase }">
                    <span class="icon" x-text="hasLowercase ? '✅' : '❌'"></span>
                    One lowercase letter
                </span>
                <span class="requirement" :class="{ 'met': hasNumber }">
                    <span class="icon" x-text="hasNumber ? '✅' : '❌'"></span>
                    One number
                </span>
                <span class="requirement" :class="{ 'met': hasSpecialChar }">
                    <span class="icon" x-text="hasSpecialChar ? '✅' : '❌'"></span>
                    One special character
                </span>
            </div>
            
            @error('password', 'updatePassword')
                <p class="input-error">❌ {{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="update_password_password_confirmation">
                {{ __('Confirm Password') }}
            </label>
            <div class="input-wrapper">
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    :type="showConfirmPassword ? 'text' : 'password'" 
                    autocomplete="new-password"
                    placeholder="Confirm new password"
                    x-model="confirmPassword"
                    :class="{
                        'error': confirmPassword && newPassword !== confirmPassword,
                        'success': confirmPassword && newPassword === confirmPassword && newPassword.length > 0
                    }"
                />
                <button type="button" class="toggle-password" @click="showConfirmPassword = !showConfirmPassword">
                    <span x-text="showConfirmPassword ? '👁️' : '👁️‍🗨️'"></span>
                </button>
            </div>
            
            <!-- Password Match Message -->
            <div x-show="confirmPassword">
                <p x-show="newPassword === confirmPassword" class="input-success">
                    ✅ Passwords match
                </p>
                <p x-show="newPassword !== confirmPassword" class="input-error">
                    ❌ Passwords do not match
                </p>
            </div>
            
            @error('password_confirmation', 'updatePassword')
                <p class="input-error">❌ {{ $message }}</p>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-primary-custom" 
                    :disabled="!isFormValid()">
                <span>💾</span> {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="success-message"
                >
                    ✅ {{ __('Password updated successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>

<script>
    function passwordManager() {
        return {
            currentPassword: '',
            newPassword: '',
            confirmPassword: '',
            showCurrentPassword: false,
            showNewPassword: false,
            showConfirmPassword: false,
            strength: '',
            
            get hasUppercase() {
                return /[A-Z]/.test(this.newPassword);
            },
            get hasLowercase() {
                return /[a-z]/.test(this.newPassword);
            },
            get hasNumber() {
                return /[0-9]/.test(this.newPassword);
            },
            get hasSpecialChar() {
                return /[!@#$%^&*(),.?":{}|<>]/.test(this.newPassword);
            },
            
            checkPasswordStrength(password) {
                if (password.length === 0) {
                    this.strength = '';
                    return;
                }
                
                let score = 0;
                if (password.length >= 8) score++;
                if (password.length >= 12) score++;
                if (this.hasUppercase) score++;
                if (this.hasLowercase) score++;
                if (this.hasNumber) score++;
                if (this.hasSpecialChar) score++;
                
                if (score <= 2) this.strength = 'weak';
                else if (score <= 4) this.strength = 'medium';
                else this.strength = 'strong';
            },
            
            isFormValid() {
                return this.newPassword.length > 0 && 
                       this.confirmPassword.length > 0 && 
                       this.newPassword === this.confirmPassword &&
                       this.newPassword.length >= 8;
            }
        };
    }
</script>