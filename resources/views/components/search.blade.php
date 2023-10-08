<div>
    @section('primary-search')
        <form action="/">
            <div class="hidden w-full lg:flex">
                <div>
                    <input placeholder="Search"  name="keyword" value="{{$_GET['keyword'] ?? ''}}"  maxlength="64" type="search" class="block w-full rounded-md border-0 py-1.5  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                </div>
                <div>
                    <button type="submit" class="hidden w-full lg:flex items-center text-sm leading-6 text-slate-400 py-1.5 pl-2  hover:ring-slate-300 dark:bg-slate-800 dark:highlight-white/5 dark:hover:bg-slate-700">
                        <svg width="24" height="24" fill="none" aria-hidden="true" class="flex-none">
                            <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> </path>
                            <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    @endsection
    @section('responsive-search')
        <form class="w-full flex" action="/">
            <div class='w-full'>
                <input placeholder="Search" name="keyword" value="{{$_GET['keyword'] ?? ''}}" maxlength="64" type="search" class="block w-full rounded-md border-0 py-1.5  text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
            </div>
            <div>
                <button type="submit" class="w-full lg:flex items-center text-sm leading-6 text-slate-400 py-1.5 pl-2 pr-3 hover:ring-slate-300 dark:bg-slate-800 dark:highlight-white/5 dark:hover:bg-slate-700">
                    <svg width="24" height="24" fill="none" aria-hidden="true" class="mr-3 flex-none">
                        <path d="m19 19-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> </path>
                        <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                    </svg>
                </button>
            </div>
        </form>
    @endsection
</div>
