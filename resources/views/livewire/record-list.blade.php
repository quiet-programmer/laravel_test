<div>

    <x-modal name="modal-1" title="Modal Title" canClose="false" height="800px"
        x-on:close-modal.window="$wire.resetForm()">
        <x-slot:body>
            @if($selectedCustomer)
            @include('livewire.includes.customer_fill_form', ['selectedCustomer' => $selectedCustomer])
            @endif
        </x-slot:body>
    </x-modal>

    <x-modal name="modal-2" title="" canClose="true" height="400px">
        <x-slot:body>
            @if($selectedCustomer)
            @include('livewire.includes.customer_d', ['selectedCustomer' => $selectedCustomer])
            @endif
        </x-slot:body>
    </x-modal>

    <x-modal name="modal-3" title="" canClose="false" height="800px">
        <x-slot:body>
            @include('livewire.includes.customer_reg_fill')
        </x-slot:body>
    </x-modal>

    <div>
        {{-- Your existing form content --}}

        @if (session()->has('message'))
        <x-alert type="success">
            {{ session('message') }}
        </x-alert>
        @endif

        @if (session()->has('error'))
        <x-alert type="error">
            {{ session('error') }}
        </x-alert>
        @endif
    </div>

    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" required="">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <button wire:click="createCustomerModal" x-data
                                x-on:click="$dispatch('open-modal', {name: 'modal-3'})"
                                class="px-4 py-2 bg-teal-800 text-white rounded">
                                <span>Add Customer</span>
                            </button>
                            <button wire:click.prevent="logout" wire:loading.attr="disabled"
                                wire:loading.class="bg-gray-400" wire:target="logout"
                                class="px-4 py-2 bg-red-800 text-white rounded">
                                <span wire:loading.remove wire:target="logout">Logout</span>
                                <span wire:loading wire:target="logout">Loading...</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div wire:poll.keep-alive class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sort-th', [
                                'name' => 'first_name',
                                'displayName' => 'First Name',
                                ])
                                @include('livewire.includes.table-sort-th', [
                                'name' => 'last_name',
                                'displayName' => 'Last Name',
                                ])
                                @include('livewire.includes.table-sort-th', [
                                'name' => 'email',
                                'displayName' => 'Email',
                                ])
                                @include('livewire.includes.table-sort-th', [
                                'name' => 'phone',
                                'displayName' => 'Phone No.',
                                ])
                                @include('livewire.includes.table-sort-th', [
                                'name' => 'created_at',
                                'displayName' => 'Joined',
                                ])
                                @include('livewire.includes.table-sort-th', [
                                'name' => 'updated_at',
                                'displayName' => 'Last update',
                                ])
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr wire:key="{{ $customer->id }}" class="border-b dark:border-gray-700">

                                <th wire:click="viewUser({{ $customer->id }})" x-data
                                    x-on:click="$dispatch('open-modal', {name: 'modal-2'})" scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap cursor-pointer">
                                    {{ $customer->first_name }}</th>
                                <td class="px-4 py-3">{{ $customer->last_name }}</td>
                                <td class="px-4 py-3">{{ $customer->email }}</td>
                                <td class="px-4 py-3">{{ $customer->first_name }}</td>
                                <td class="px-4 py-3">{{ $customer->created_at }}</td>
                                <td class="px-4 py-3">{{ $customer->updated_at }}</td>

                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button wire:click="editUser({{ $customer->id }})" x-data
                                        x-on:click="$dispatch('open-modal', {name: 'modal-1'})"
                                        class="px-3 py-1 bg-teal-800 text-white rounded">Edit</button>
                                    <button
                                        onclick="return confirm('Are you sure you want to delete {{ $customer->first_name }}?') || event.stopImmediatePropagation();"
                                        wire:click="delete({{ $customer->id }})"
                                        class="px-3 py-1 ml-2 bg-red-500 text-white rounded">X</button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live="perPage"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </section>
</div>