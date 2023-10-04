<div>
    <div class="max-w-4xl mx-auto relative z-20 pt-10 xl:max-w-none text-black break-words w-full whitespace-normal">
        <div class="text-2xl font-normal text-center p-4 text-gray-700"> 欢迎一起交流 ~ </div>
        @foreach ($comments as $comment)
        <div class="w-full">
            <div class="py-2"> Penggeor  <span class="text-gray-400"> 13 天前</span></div>
            <div class="text-gray-800 py-4 text-1xl"> 希望可以出一期介绍 RSS 应用的 </div>
            <div class="grid grid-cols-2  text-gray-800 py-4 text-sm">
                <div class="cursor-pointer pl-2">回复</div>
                <div class="text-right">0 条回复</div>
            </div>
        </div>
        @endforeach
        <form wire:submit.prevent="addComment">
            <div class="w-full">
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
