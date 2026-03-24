<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('dashboard') }}">
            <img src="{{ asset('./assets/img/logo.png') }}"
                class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
            <img src="{{ asset('./assets/img/logo.png') }}"
                class="hidden h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
            <span
                class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">{{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('dashboard') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('dashboard') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-blue-500 fa fa-home"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Bảng điều khiển</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('recipe.*') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('recipe.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-orange-500 fa fa-book"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Công thức của tôi</span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('blogs.*') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('blogs.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-amber-500 fa fa-newspaper-o"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Xem bài viết</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('my-blogs.*') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('my-blogs.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-pencil text-sm text-amber-500"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Bài viết của tôi</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('favorite.*') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('favorite.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-emerald-500 fa fa-star"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Yêu thích</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('comment.*') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('comment.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-cyan-500 fa fa-comments"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Bình luận của tôi</span>
                </a>
            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Cài đặt</h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class="{{ request()->routeIs('profile.*') ? 'bg-blue-500/13 rounded-lg text-slate-700 font-semibold' : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('profile.edit') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-slate-700 fa fa-user"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Hồ sơ</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <form action="{{ route('logout') }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-red-600 fa fa-sign-out"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-red-600">Đăng
                            xuất</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
