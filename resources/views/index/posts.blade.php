<x-base-layout>
    @livewire('posts',['id'=>$id])
    @section('scripts')
        {!! editor_preview_init() !!}
    @endsection
</x-base-layout>
