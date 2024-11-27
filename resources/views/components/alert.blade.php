@props(['type' => 'success'])

@php
$classes = match($type) {
'success' => 'bg-green-100 text-green-800 border-green-400',
'error' => 'bg-red-100 text-red-800 border-red-400',
default => 'bg-green-100 text-green-800 border-green-400'
};
@endphp

<div x-data="{ show: true }" x-show="show" x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" x-init="setTimeout(() => show = false, 3000)" class="fixed top-4 right-4 z-50">
    <div class="rounded-md p-4 border {{ $classes }}">
        <div class="flex">
            <div class="flex-shrink-0">
                @if($type === 'success')
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                @else
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                @endif
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">
                    {{ $slot }}
                </p>
            </div>
        </div>
    </div>
</div>