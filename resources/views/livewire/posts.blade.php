<div class="overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
            class="hidden lg:block fixed z-20  top-[3.8125rem]  right-auto w-[14rem] pb-10 pr-2 overflow-y-auto max-h-full">
            <nav id="nav" class="lg:text-sm lg:leading-6 relative ">
                <div class="sticky top-0 -ml-0.5 pointer-events-none">
                    <div class="h-8 bg-gradient-to-b dark:from-slate-900"></div>
                </div>
                <ul>
                    @foreach($articles as $item)
                        <li><a class="group flex items-center lg:leading-6  py-2 hover:text-orange-600 text-lg {{$item->id == request()->route('id') ?"text-orange-600":"text-black"}}"
                               href="{{route('posts',$item->id)}}"  wire:navigate > {{$item->title}} - {{$item->subtitle}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="lg:pl-[15rem]">
            <header id="header" class="relative z-20 py-10">
                <div>
                    <div class="flex items-center pt-2">
                        <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight dark:text-slate-200">
                            <span class="truncate"> {{$article->title}} - {{$article->subtitle}}</span>
                        </h1>
                    </div>
                </div>
            </header>
            <main class="max-w-4xl mx-auto relative z-20 pt-4 xl:max-w-none text-black break-words w-full whitespace-normal">
                <div id="editormd_preview_id">
                    <textarea style="display: none"> {!!$article->feeds->content!!}</textarea>
                </div>
                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        发布日期:{{$article->feeds->created_at->format('Y/m/d')}}
                    </div>
                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        @if($prev)
                            <a href="{{route('posts',$prev->id)}}"   wire:navigate>上一篇</a>|
                        @endif
                        @if($next)
                            <a href="{{route('posts',$next->id)}}"   wire:navigate>下一篇</a>|
                        @endif
                        <a href="/">去首页</a>
                    </div>
                </div>
                <div class="hidden sm:block">
                    <div class="pb-4 pt-8">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
                @livewire('posts-comments')
            </main>
        </div>
    </div>
</div>

@section('articles')
    <div class="pt-2 pb-3 space-y-1">
        @foreach($articles as $item)
            <x-responsive-nav-link wire:navigate href="{{route('posts',$item->id)}}" :active="$item->id===$article->id">{{$item->title}} - {{$item->subtitle}}</x-responsive-nav-link>
        @endforeach
    </div>
@endsection
