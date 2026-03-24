<x-app-layout>
    <aside
        class="fixed inset-y-0 flex-wrap items-center content-center justify-between block w-full mt-36 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">

        <div class="items-center justify-center flex flex-col w-full max-h-screen overflow-auto grow basis-full">
            <img src="{{ asset('/storage/images/banner.jpg') }}" class="w-48 h-48 object-cover rounded-lg mb-4"
                alt="hinh_chinh" />

            @auth
                <h2 class="text-center text-xl font-semibold mb-2">Khám phá công thức <br> Trọn vị yêu thương</h2>
            @else
                <h2 class="text-center text-xl font-semibold mb-2">Tham gia cộng đồng của chúng tôi!</h2>
            @endauth


            <p class="text-gray-700 mb-4 text-sm text-center p-4">
                Chia sẻ công thức nấu ăn yêu thích của bạn và kết nối với những người đam mê ẩm thực.
            </p>

            @auth
                <a href="{{ route('recipe.index') }}"
                    class="inline-block px-8 py-2 mb-0 mr-1 font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-green-500 border-0 rounded-lg shadow-md cursor-pointer hover:-translate-y-px hover:shadow-xs active:opacity-85 text-xs tracking-tight-rem">
                    Công thức của tôi
                </a>
            @else
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-2 mb-0 mr-1 font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-green-500 border-0 rounded-lg shadow-md cursor-pointer hover:-translate-y-px hover:shadow-xs active:opacity-85 text-xs tracking-tight-rem">
                    Đăng ký
                </a>
            @endauth

        </div>
    </aside>
    <div class="relative w-full mx-auto px-4 pb-16 pt-32 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div
                class="mb-10 rounded-[2rem] bg-gradient-to-r from-amber-50 via-white to-orange-50 p-8 shadow-xl shadow-orange-100/40">
                <div class="grid gap-8 lg:grid-cols-12 lg:items-stretch">

                    <div class="lg:col-span-9 flex flex-col justify-between gap-8">
                        <div class="px-4">
                            <span
                                class="inline-flex rounded-full bg-orange-100 py-1 text-xs font-bold uppercase tracking-[0.24em] text-orange-600">
                                Chuyên mục bài viết
                            </span>
                            <h1 class="mt-4 text-4xl font-bold text-slate-800 sm:text-5xl">
                                Góc chia sẻ về món ăn, nguyên liệu và câu chuyện bếp núc
                            </h1>
                            <p class="mt-4 max-w-3xl text-base leading-7 text-slate-500">
                                Tổng hợp các bài viết giới thiệu món ăn, mẹo nấu nướng và cảm hứng ẩm thực theo phong
                                cách đồng bộ với trang công thức hiện tại.
                            </p>
                            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-slate-500">
                                <span
                                    class="rounded-full bg-white px-4 py-2 shadow-sm">{{ $blogs->total() + ($featuredBlog ? 1 : 0) }}
                                    bài viết</span>
                                <span class="rounded-full bg-white px-4 py-2 shadow-sm">Cập nhật liên tục</span>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-[2rem] bg-slate-900 p-6 text-white shadow-2xl">
                            <div class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-orange-400/20 blur-2xl">
                            </div>
                            <div class="absolute -bottom-16 left-8 h-40 w-40 rounded-full bg-amber-300/20 blur-2xl">
                            </div>
                            @if ($featuredBlog)
                                <p class="text-xs uppercase tracking-[0.3em] text-orange-200"
                                    style="color: rebeccapurple;">
                                    Bài viết nổi bật</p>
                                <h2 class="mt-3 text-2xl font-bold leading-tight">{{ $featuredBlog->title }}</h2>
                                <p class="mt-4 text-sm leading-6 text-slate-300" style="color: rebeccapurple;">
                                    {{ $featuredBlog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($featuredBlog->content), 180) }}
                                </p>
                                <div class="mt-6 flex items-center gap-3 text-sm text-slate-300">
                                    <span style="color: rebeccapurple;">{{ $featuredBlog->author->name }}</span>
                                    <span class="h-1 w-1 rounded-full bg-slate-500"></span>
                                    <span
                                        style="color: rgb(208, 159, 26);">{{ optional($featuredBlog->published_at)->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('blogs.show', $featuredBlog) }}"
                                    class="mt-6 inline-flex items-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-slate-800 transition hover:-translate-y-0.5">
                                    Đọc bài nổi bật
                                </a>
                            @else
                                <p class="text-sm text-slate-300">Hiện chưa có bài viết nào được xuất bản.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3 mb-5">
                @forelse ($blogs as $item)
                    <article
                        class="group overflow-hidden rounded-[1.75rem] bg-white shadow-xl shadow-slate-200/60 transition duration-300 hover:-translate-y-1">
                        <a href="{{ route('blogs.show', $item) }}" class="block">
                            <div class="relative h-60 overflow-hidden">
                                <img src="{{ $item->thumbnail_path ? asset('storage/' . $item->thumbnail_path) : asset('assets/img/recipe_book.jpg') }}"
                                    alt="{{ $item->title }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/10 to-transparent">
                                </div>
                                <span
                                    class="absolute left-5 top-5 rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-slate-700">
                                    {{ optional($item->published_at)->diffForHumans() }}
                                </span>
                            </div>
                            <div class="p-6">
                                <div
                                    class="flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.18em] text-orange-500">
                                    <span>{{ $item->author->name }}</span>
                                    <span class="h-1 w-1 rounded-full bg-orange-300"></span>
                                    <span>Bài viết</span>
                                </div>
                                <h2 class="mt-3 text-xl font-bold leading-8 text-slate-800">{{ $item->title }}</h2>
                                <p class="mt-3 text-sm leading-6 text-slate-500">
                                    {{ $item->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($item->content), 140) }}
                                </p>
                                <div class="mt-5 inline-flex items-center text-sm font-bold text-orange-600">
                                    Xem chi tiết
                                    <span class="ml-2 transition group-hover:translate-x-1">→</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <div
                        class="col-span-full rounded-[1.75rem] border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                        <h2 class="text-xl font-bold text-slate-700">Chưa có bài viết nào</h2>
                        <p class="mt-2 text-sm text-slate-500">Sau khi admin xuất bản bài viết từ trang quản trị, danh
                            sách sẽ hiển thị tại đây.</p>
                    </div>
                @endforelse
            </div>

            @if ($blogs->hasPages())
                <div class="mt-10">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
