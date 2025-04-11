<section class="profile-section">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to secure account.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="form-container">
        @csrf
        @method('put')

        <!-- Current Password Input -->
        <div class="input-group">
            <label for="update_password_current_password" class="input-label">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="text-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="input-error" />
        </div>

        <!-- New Password Input -->
        <div class="input-group">
            <label for="update_password_password" class="input-label">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="text-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="input-error" />
        </div>

        <!-- Confirm Password Input -->
        <div class="input-group">
            <label for="update_password_password_confirmation" class="input-label">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="text-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="input-error" />
        </div>

        <!-- Save Button -->
        <div class="save-button-group">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="saved-status" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<!-- CSS -->
<style>
    /* Profile section styling */
    .profile-section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 40vh;
        background-color: #f7fafc;
    }

    /* Form container styling */
    .form-container {
        width: 33.33%;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* Input group layout */
    .input-group {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* Label styling */
    .input-label {
        width: 30%;
        font-size: 14px;
        color: #4a5568;
    }

    /* Input field styling */
    .text-input {
        width: 70%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        background-color: #f9fafb;
        transition: border-color 0.2s ease;
    }

    /* Input focus effect */
    .text-input:focus {
        outline: none;
        border-color: #63b3ed;
    }

    /* Error message styling */
    .input-error {
        color: red;
        font-size: 12px;
        margin-top: 4px;
    }

    /* Save button styling */
    .save-button-group {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
    }

    /* Success message for saving */
    .saved-status {
        font-size: 12px;
        color: green;
    }
</style>
