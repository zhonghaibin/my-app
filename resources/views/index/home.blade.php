<x-base-layout>
    <div class="relative  sm:justify-center bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-4 lg:p-4">
            @livewire('home-list')
        </div>
    </div>
    <x-search></x-search>
</x-base-layout>
