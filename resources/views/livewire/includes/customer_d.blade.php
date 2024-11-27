<div class="p-6 max-h-[80vh] overflow-y-auto">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Customer Profile</h2>
        <p class="text-sm text-gray-500">Customer ID: #{{ $selectedCustomer->id }}</p>
    </div>

    <!-- Customer Info -->
    <div class="space-y-4">
        <!-- Basic Info -->
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Name</h3>
                    <p class="text-gray-900">{{ $selectedCustomer->first_name }} {{
                        $selectedCustomer->last_name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Email</h3>
                    <p class="text-gray-900">{{ $selectedCustomer->email }}</p>
                </div>
            </div>
        </div>

        <!-- Status and Dates -->
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Status</h3>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $selectedCustomer->status->value === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($selectedCustomer->status->value) }}
                    </span>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Member Since</h3>
                    <p class="text-gray-900">{{ $selectedCustomer->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Additional Details -->
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Phone</h3>
                    <p class="text-gray-900">{{ $selectedCustomer->phone ?? 'Not provided' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Last Activity</h3>
                    <p class="text-gray-900">{{ $selectedCustomer->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>