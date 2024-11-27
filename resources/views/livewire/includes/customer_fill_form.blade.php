<div class="p-4">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Edit Customer Details</h2>

    <form wire:submit="updateCustomer" class="space-y-6">
        <!-- Personal Information -->
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-gray-700">Personal Information</h3>

            <div class="grid grid-cols-2 gap-4">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First
                        Name</label>
                    <input type="text" wire:model.live="form.first_name" id="first_name"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter first name">
                    @error('form.first_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last
                        Name</label>
                    <input type="text" wire:model.live="form.last_name" id="last_name"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter last name">
                    @error('form.last_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Email & Phone -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" wire:model.live="form.email" id="email"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter email">
                    @error('form.email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="tel" wire:model.live="form.phone" id="phone"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter phone">
                    @error('form.phone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Date of Birth & Status -->
            <div class="grid grid-cols-2 gap-4">
                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of
                        Birth</label>
                    <input type="date" wire:model.live="form.date_of_birth" id="date_of_birth"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                    @error('form.date_of_birth')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model.live="form.status" id="status"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Select status</option>
                        @foreach(App\Enums\StatusEnum::cases() as $status)
                        <option value="{{ $status->value }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('form.status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-gray-700">Address Information</h3>

            <!-- Street Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street
                    Address</label>
                <input type="text" wire:model.live="form.address" id="address"
                    class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Enter street address">
                @error('form.address')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- City & Postcode -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" wire:model.live="form.city" id="city"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter city">
                    @error('form.city')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="postcode" class="block text-sm font-medium text-gray-700 mb-1">Postcode</label>
                    <input type="text" wire:model.live="form.postcode" id="postcode"
                        class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter postcode">
                    @error('form.postcode')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea wire:model.live="form.notes" id="notes" rows="3"
                class="w-full p-2.5 border-2 border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                placeholder="Enter any additional notes"></textarea>
            @error('form.notes')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-6 mt-6 border-t border-gray-200">
            <button @disabled($form->hasEmptyFields()) type="submit"
                wire:loading.attr="disabled" class="flex-1 {{
                $form->hasEmptyFields()
                ? 'bg-gray-300 cursor-not-allowed'
                : 'bg-teal-800 text-white' }} text-white px-4 py-2.5 rounded-md text-sm font-medium
                disabled:opacity-50">
                <span wire:loading.remove wire:target="updateCustomer">Update Customer</span>
                <span wire:loading wire:target="updateCustomer">Updating...</span>
            </button>

            <button type="button" x-on:click="$dispatch('close-modal')" wire:click="resetForm"
                class="flex-1 bg-white border-2 border-gray-300 text-gray-700 px-4 py-2.5 rounded-md text-sm font-medium hover:bg-gray-50">
                Cancel
            </button>
        </div>
    </form>
</div>