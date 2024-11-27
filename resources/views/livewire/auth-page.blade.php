<div>
    <!-- Create New Account Section -->
    <div class="bg-white rounded-lg shadow p-20">
        <h2 class="text-2xl font-bold mb-4">Login</h2>
        <form wire:submit="loginUser">

            <div class="mb-4">
                <label for="email" class="block mb-2">Email</label>
                <input wire:model="form.email" type="email" id="email" placeholder="email.."
                    class="w-full p-2 border rounded">
                @error('form.email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2">Password</label>
                <input wire:model="form.password" placeholder="password.." type="password" id="password"
                    class="w-full p-2 border rounded">
                @error('form.password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button wire:loading.attr="disabled" wire:loading.class="bg-gray-400" wire:target="loginUser"
                class="px-4 py-2 bg-teal-800 text-white rounded">
                <span wire:loading.remove wire:target="loginUser">Login</span>
                <span wire:loading wire:target="loginUser">Loading...</span>
            </button>
        </form>
    </div>
</div>