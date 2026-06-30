<!-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf -->

        <!-- Name -->
        <!-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> -->

        <!-- Email Address -->
        <!-- <div >
            <label for="email" :value="__('Email')" >
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')"  />
        </div> -->

        <!-- Password -->
        <!-- <div >
            <label for="password" :value="__('Password')">

            <input id="password" 
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')"  />
        </div> -->

        <!-- Confirm Password -->
        <!-- <div >
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" 
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')"  />
        </div> -->

        <!-- <div >
            <a  href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button >
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>  -->


<x-guest-layout>
    {{-- Externalized CSS Sheet Link --}}
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">

    <div class="auth-card-container">
        {{-- Header Section --}}
        <div class="header-logo-group">
            <span class="brand-name">smart discussion forum</span>
        </div>

        <h1 class="main-title">{{ __('Registration form') }}</h1>
        <p class="sub-title">{{ __('create your new account') }}</p>
        <p class="form-status">{{ __('registration is currently active') }}</p>

        {{-- Form Section --}}
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="grid-container">
                {{-- Left Column: Core Input Elements --}}
                <div class="grid-column">
                    {{-- Role Selection Group --}}
                    <div class="form-group-custom">
                        <label for="role" class="label-custom">{{ __('Register As:') }}</label>
                        <select id="role" name="role" required class="input-custom select-custom">
                            <option value="" disabled selected>{{ __('Select Role...') }}</option>
                            <option value="student">{{ __('Student') }}</option>
                            <option value="lecturer">{{ __('Lecturer') }}</option>
                            <option value="admin">{{ __('Admin') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    {{-- Name Field --}}
                    <div class="form-group-custom">
                        <label for="name" class="label-custom">{{ __('Name:') }}</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autocomplete="name" class="input-custom" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email Address Field --}}
                    <div class="form-group-custom">
                        <label for="email" class="label-custom">{{ __('Email address:') }}</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="email" class="input-custom" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Create Password Field --}}
                    <div class="form-group-custom">
                        <label for="password" class="label-custom">{{ __('Create Password:') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="input-custom" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password Field --}}
                    <div class="form-group-custom">
                        <label for="password_confirmation" class="label-custom">{{ __('Confirm Password:') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="input-custom" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                {{-- Right Column: Dynamic Role Feature Box --}}
                <div class="grid-column">
                    <div id="dynamicFieldsContainer" class="hidden-fields-container">
                        
                        {{-- Default Placeholder (Visible only when no role is selected) --}}
                        <div id="placeholderFields" class="form-group-custom">
                            <label class="label-custom" style="color:#6b7280; font-weight:normal;">{{ __('Specific role-based fields will appear here...') }}</label>
                        </div>
                        
                        {{-- Specialized structural contexts for Admin --}}
                        <div id="adminFields" class="form-group-custom" style="display: none;">
                            <label for="admin_id" class="label-custom">{{ __('Admin ID:') }}</label>
                            <input id="admin_id" type="text" name="admin_id" class="input-custom" />
                            <x-input-error :messages="$errors->get('admin_id')" class="mt-2" />
                        </div>
                        
                        {{-- Specialized structural contexts for Lecturer --}}
                        <div id="lecturerFields" class="form-group-custom" style="display: none;">
                            <label for="staff_id" class="label-custom">{{ __('Staff ID:') }}</label>
                            <input id="staff_id" type="text" name="staff_id" class="input-custom" />
                            <x-input-error :messages="$errors->get('staff_id')" class="mt-2" />
                        </div>

                        {{-- Specialized structural contexts for Student --}}
                        <div id="studentFields" class="form-group-custom" style="display: none;">
                            <label for="registration_id" class="label-custom">{{ __('Registration ID:') }}</label>
                            <input id="registration_id" type="text" name="registration_id" class="input-custom" />
                            <x-input-error :messages="$errors->get('registration_id')" class="mt-2" />

                            <label for="group_id" class="label-custom mt-2">{{ __('Group ID:') }}</label>
                            <input id="group_id" type="text" name="group_id" class="input-custom" />
                            <x-input-error :messages="$errors->get('group_id')" class="mt-2" />
                            
                            <label for="course" class="label-custom mt-2">{{ __('Course:') }}</label>
                            <input id="course" type="text" name="course" class="input-custom" />
                            <x-input-error :messages="$errors->get('course')" class="mt-2" />
                            
                            <label for="college" class="label-custom mt-2">{{ __('College:') }}</label>
                            <select id="college" name="college" class="input-custom select-custom">
                                <option value="" disabled selected>{{ __('Select College --') }}</option>
                                <option value="eng">{{ __('College of Engineering') }}</option>
                                <option value="arts">{{ __('College of Arts & Sciences') }}</option>
                                <option value="biz">{{ __('School of Business') }}</option>
                                <option value="edu">{{ __('College of Education') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('college')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Policy Compliance Context Area --}}
            <div class="policy-group">
                <div class="policy-agreement">
                    <input id="policy_agreement" type="checkbox" name="policy_agreement" required class="policy-check" />
                    <label for="policy_agreement">
                        {{ __('I agree to the') }} 
                        <a href="#" class="link-policy">{{ __('terms and conditions') }}</a> 
                        {{ __('and') }} 
                        <a href="#" class="link-policy">{{ __('privacy policy') }}</a>
                    </label>
                </div>
                <p id="policyWarning" class="warning-text" style="display: none;">
                    {{ __('You must agree to our terms and conditions to access the system') }}
                </p>
            </div>

            {{-- Primary Submit Block --}}
            <div class="action-container">
                <button type="submit" class="btn-register-custom">
                    {{ __('Register') }}
                </button>

                <div class="footer-login">
                    {{ __('Already have an account?') }} 
                    <a href="{{ route('login') }}" class="link-login">
                        {{ __('sign in') }}
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Script controlling visibility toggles --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const placeholderFields = document.getElementById('placeholderFields');
            const adminFields = document.getElementById('adminFields');
            const lecturerFields = document.getElementById('lecturerFields');
            const studentFields = document.getElementById('studentFields');

            roleSelect.addEventListener('change', function() {
                // Toggle placeholder based on selection status
                if (this.value === '') {
                    placeholderFields.style.display = 'block';
                } else {
                    placeholderFields.style.display = 'none';
                }

                // Handle Admin View
                if (this.value === 'admin') {
                    adminFields.style.display = 'block';
                } else {
                    adminFields.style.display = 'none';
                }

                // Handle Lecturer View
                if (this.value === 'lecturer') {
                    lecturerFields.style.display = 'block';
                } else {
                    lecturerFields.style.display = 'none';
                }

                // Handle Student View
                if (this.value === 'student') {
                    studentFields.style.display = 'block';
                } else {
                    studentFields.style.display = 'none';
                }
            });

            const form = document.getElementById('registerForm');
            const policyCheck = document.getElementById('policy_agreement');
            const policyWarning = document.getElementById('policyWarning');

            form.addEventListener('submit', function(event) {
                if (!policyCheck.checked) {
                    event.preventDefault();
                    policyWarning.style.display = 'block';
                }
            });
            
            policyCheck.addEventListener('change', function() {
                if (this.checked) {
                    policyWarning.style.display = 'none';
                }
            });
        });
    </script>
</x-guest-layout>