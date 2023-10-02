<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           编辑文章
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" xmlns="http://www.w3.org/1999/html">
                    <form method="POST" action="{{route('article.save',$article->id)}}" >
                      @csrf
                        <div>
                            <x-label for="title" value="标题" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$article->title}}"  required autofocus autocomplete="标题" />
                        </div>
                        <div>
                            <x-label for="subtitle" value="副标题" />
                            <x-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" value="{{$article->subtitle}}"  required autofocus autocomplete="副标题" />
                        </div>
                        <div>
                            <x-label for="status" value="发布状态"/>
                            <select id="status" name="status"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="{{\App\Enum\Article::STATUS_OPEN }}"  {{$article->status ==\App\Enum\Article::STATUS_OPEN ?'selected':''}}> 上架</option>
                                <option value="{{\App\Enum\Article::STATUS_CLOSE}}"  {{$article->status ==\App\Enum\Article::STATUS_CLOSE ?'selected':''}}> 下架</option>
                            </select>
                        </div>
                        <div>
                        </div>
                        <div>
                            <x-label for="content" value="内容" />
                            <div id="editormd_id">
                                <textarea name="content" style="display:none;"> {!!$article->feeds->content!!}</textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                编辑
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('styles')
        {!! editor_css() !!}
    @endsection
    @section('scripts')
        <script src="//cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>
        {!! editor_js() !!}
        {!! editor_init() !!}
    @endsection
</x-app-layout>
