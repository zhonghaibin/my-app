<div>
    <div class="max-w-4xl mx-auto relative z-20 pt-10 xl:max-w-none text-black break-words w-full whitespace-normal">
        <div class="text-2xl font-normal text-center p-4 text-gray-700"> 欢迎一起交流 ~ </div>
        @foreach ($comments as $comment)
        <div class="w-full">
            <div class="py-2 grid grid-cols-2">
                <span>{{$comment->user->name}}
                        @if($comment->pid) 回复 {{$comment->comment->user->name}}
                    @endif
                </span>
                <span class="text-gray-400 text-right"> {{ $comment->created_at}}</span>
            </div>
            <div class="text-gray-800 py-4 text-1xl"> {{$comment->content}} </div>
            <div class="grid grid-cols-2  text-gray-800 py-4 text-sm">
                <div class="pl-2">
                    <a href="#" class="text-xs cursor-pointer rounded-md bg-green-600 p-1 text-gray-50" wire:click="replies({{$comment->id}})">回复</a>
                    @auth
                        @if(auth()->user()->id==$comment->user_id)
                        <span wire:click="delComment({{$comment->id}})" class="cursor-pointer text-xs rounded-md bg-red-600 p-1 text-gray-50" >删除</span>
                        @endif
                    @endauth
                </div>
                <div class="text-right">
                    <span> {{$comment->replies_count}} 条回复</span>
                </div>
            </div>
            <form wire:submit="addReplies"  class="{{$comment->id==$this->comment_id && $hidden?'':'hidden'}}">
                <div class="w-full">
                    <input type="hidden" wire:model="comment_id">
                    <textarea wire:model="replies_content" rows="3" class="w-full rounded-md border-0 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    @error('replies_content') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="p-1">
                    <button type="submit" class="text-sm m-2 px-3 text-gray-400 outline-gray-400 rounded outline outline-offset-1 outline-1" >
                        回复
                    </button>
                </div>
            </form>

        </div>
        @endforeach
        <form wire:submit="addComment">
            <div class="w-full">
                <input type="hidden" wire:model="article_id">
                <textarea wire:model="content" rows="3" class="w-full rounded-md border-0 text-gray-900 ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="p-1">
                <button type="submit" class="text-sm m-2 px-3 text-gray-400 outline-gray-400 rounded outline outline-offset-1 outline-1" >
                    提交
                </button>
            </div>
        </form>
    </div>
</div>
