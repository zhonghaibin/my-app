<div>
    <div class="flex items-center justify-end mt-4">
        <a class=" text-sm  m-6 p-1 text-gray-600 hover:text-gray-900 rounded-md  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 outline outline-offset-2 outline-1" href="{{ route('article.create') }}">
            添加文章
        </a>
    </div>
    <div class="max-w-7xl">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 ">
            @forelse($articles as $article)
                <div class="scale-100 bg-white from-gray-700/50 via-transparent  shadow-2xl shadow-gray-500/20 flex  transition-all duration-250 m-1">
                    <div class="text-sm font-mon  w-full">
                        <a href="{{route('posts',$article->id)}}">
                            <div class="flex items-center justify-center">
                                    <img  src="{{$article->cover}}"  class="object-cover object-center h-40 w-full rounded-t-lg">
                            </div>
                        </a>
                        <div class="p-3 subpixel-antialiased">
                            <div class="w-full flex justify-between items-center leading-tight">
                                <div class="text-gray-800 truncate">  {{$article->title}} -  {{$article->subtitle}}</div>
                                <div class="text-sm text-gray-600">{{$article->feeds->created_at->format('Y/m/d')}}</div>
                            </div>
                            <p class="mt-2 text-slate-600 leading-relaxed text-xs line-clamp-2 h-10">
                                {{$article->description}}
                            </p>
                        </div>
                        <div class="flex justify-end ">
                            <a href="{{route('article.edit',$article->id)}}" class="text-sm  m-2  hover:text-gray-900 rounded-md  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 bg-green-600 p-1 text-gray-50">编辑</a>
                            <a href="#" class="text-sm  m-2 hover:text-gray-900 rounded-md  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  bg-red-600 p-1 text-gray-50" wire:click="delete({{$article->id}})">删除</a>
                        </div>
                    </div>
                </div>
            @empty
                <span class="justify-center text-center col-span-4 p-3">暂无数据</span>
            @endforelse
        </div>

    </div>
</div>
