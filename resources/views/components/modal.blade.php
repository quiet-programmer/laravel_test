@props(['name', 'title', 'canClose', 'height'])
<div x-data="{ show: false, name: '{{ $name }}' }" x-show="show"
    x-on:open-modal.window="show = ($event.detail.name === name)"
    x-on:close-modal.window="show = false; $wire.resetForm()"
    x-on:keydown.escape.window="show = false; $wire.resetForm()" x-transition style="display: none;"
    class="fixed z-50 inset-0">

    {{-- Gray Background --}}
    @if ($canClose == 'true')
    <div x-on:click="show = false" class=" fixed bg-gray-300 inset-0 bg-opacity-40"></div>
    @else
    <div class="fixed bg-gray-300 inset-0 bg-opacity-40"></div>
    @endif

    {{-- Main Content --}}
    <div class="bg-white rounded-lg m-auto fixed inset-0 max-w-2xl overflow-y-auto " style="max-height: {{ $height }}">

        {{-- @if(@isset($title))
        <div class="py-3 flex items-center justify-center">
            {{ $title }}
        </div>
        @endif --}}

        <div>
            {{ $body }}
        </div>
    </div>
</div>