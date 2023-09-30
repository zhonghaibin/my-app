<div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" xmlns="http://www.w3.org/1999/html">
    <form method="POST" wire:submit="save" >
        <div>
            <x-label for="journal" value="期数" />
            <x-input id="journal" class="block mt-1 w-full" type="text" wire:model="journal"  required autofocus autocomplete="期数" />
        </div>
        <div>
            <x-label for="title" value="标题" />
            <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title"  required autofocus autocomplete="标题" />
        </div>
        <div>
            <x-label for="description" value="描述" />
            <x-input id="description" class="block mt-1 w-full" type="text" wire:model="description"  required autofocus autocomplete="描述" />
        </div>
        <div>
            <x-label for="keywords" value="关键词" />
            <x-input id="keywords" class="block mt-1 w-full" type="text" wire:model="keywords"  required autofocus autocomplete="关键词" />
        </div>
        <div>
            <x-label for="cover" value="封面" />
            <x-input id="cover" class="block mt-1 w-full" type="text" wire:model="cover"  required autofocus autocomplete="封面" />
        </div>
        <div>
            <x-label for="status" value="发布状态"/>
            <select id="status" wire:model="status"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="1"> 上架</option>
                <option value="0"> 下架</option>
            </select>
        </div>
        <div>
            <x-label for="content" value="内容" />
            <textarea id="content"  rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"  type="text" wire:model="content"  autocomplete="内容" ></textarea>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
               添加
            </x-button>
        </div>
    </form>
</div>
