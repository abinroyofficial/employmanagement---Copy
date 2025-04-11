<section class="profile-section">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>
        <x-danger-button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</x-danger-button>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be  deleted. are you really want to delete user !!!, if then please input the user name,password') }}
        </p>
    </header>



    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="form-container">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
            </p>

            <!-- Password Input -->
            <div class="input-group">
                <label for="password" class="input-label">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" class="text-input"
                    placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="input-error" />
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons mt-6 flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
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
