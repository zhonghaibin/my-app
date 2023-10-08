<div class="grid grid-cols-1 md:grid-cols-4 gap-4 lg:gap-4 w-full">
    @forelse($articles as $article)
        <a href="{{route('posts',$article->id)}}" wire:navigate
           class="scale-100 bg-white from-gray-700/50 via-transparent  shadow-2xl shadow-gray-500/20 flex  transition-all duration-250">
            <div class="text-sm font-mon w-full rounded-t-lg">
                <div class="flex items-center justify-center rounded-t-lg">
                    <img src="{{$article->cover}}" class="object-cover object-center h-40 w-full rounded-t-lg">
                </div>
                <div class="p-3 subpixel-antialiased">
                    <div class="w-full flex justify-between items-center leading-tight">
                        <div class="text-gray-800 truncate text-sm">  {{$article->title}} - {{$article->subtitle}}</div>
                        <div
                            class="text-sm text-gray-600">{{$article->feeds->created_at->format('Y/m/d')}}</div>
                    </div>
                    <p class="mt-2 text-slate-600 leading-relaxed text-sm line-clamp-2 h-10">
                        {{$article->description}}
                    </p>
                </div>
            </div>
        </a>
    @empty
        <span class="justify-center text-center col-span-4 p-3">暂无数据</span>
    @endforelse
</div>
