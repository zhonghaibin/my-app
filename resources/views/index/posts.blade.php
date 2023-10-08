<x-base-layout>
    @livewire('posts',['id'=>$id])
    @section('scripts')
        {!! editor_preview_init() !!}
    @endsection
    <x-search></x-search>
</x-base-layout>
