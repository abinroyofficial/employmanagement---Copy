<section class="profile-section">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information  name and email address here.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="form-container">
        @csrf
        @method('patch')

        <!-- Name Input -->
        <div class="input-group">
            <label for="name" class="input-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="text-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="input-error" :messages="$errors->get('name')" />
        </div>

        <!-- Email Input -->
        <div class="input-group">
            <label for="email" class="input-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="text-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="input-error" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-info">
                    <p class="text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="verification-button">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="verification-status">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="save-button-group">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
        height: 30vh;
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

    /* Button styling */
    .save-button-group {
        display: flex;
        justify-content: flex-start;
        gap: 12px;
    }

    .verification-info {
        margin-top: 10px;
    }

    .verification-button {
        text-decoration: underline;
        color: #4a5568;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .verification-status {
        font-size: 12px;
        color: green;
        margin-top: 4px;
    }

    .saved-status {
        font-size: 12px;
        color: green;
    }
</style>
