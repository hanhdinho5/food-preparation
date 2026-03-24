<x-app-layout>
    @guest
        <aside
            class="fixed inset-y-0 flex-wrap items-center content-center justify-between block w-full mt-36 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
            aria-expanded="false">

            <div class="items-center justify-center flex flex-col w-full max-h-screen overflow-auto grow basis-full">
                <img src="{{ asset('./assets/img/masakan.jpg') }}" class="w-48 h-48 object-cover rounded-lg mb-4"
                    alt="hinh_chinh" />

                <h2 class="text-center text-xl font-semibold mb-2">Tham gia cộng đồng của chúng tôi!</h2>

                <p class="text-gray-700 mb-4 text-sm text-center p-4">
                    Chia sẻ công thức nấu ăn yêu thích của bạn và kết nối với những người đam mê ẩm thực.
                </p>

                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-2 mb-0 mr-1 font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-green-500 border-0 rounded-lg shadow-md cursor-pointer hover:-translate-y-px hover:shadow-xs active:opacity-85 text-xs tracking-tight-rem">
                    Đăng ký
                </a>
            </div>
        </aside>
    @endguest
    <div class="relative w-full mx-auto px-4 pb-16 pt-32 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl">
            <a href="{{ route('blogs.index') }}"
                class="mb-6 inline-flex items-center rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:-translate-y-0.5">
                ← Quay lại danh sách bài viết
            </a>

            <article class="overflow-hidden rounded-[2rem] bg-white shadow-2xl shadow-slate-200/70">
                <div class="relative h-[320px] overflow-hidden sm:h-[420px]">
                    <img src="{{ $blog->thumbnail_path ? asset('storage/' . $blog->thumbnail_path) : asset('assets/img/recipe_book.jpg') }}"
                        alt="{{ $blog->title }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/30 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 sm:p-10">
                        <div
                            class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-[0.22em] text-orange-200">
                            <span>{{ $blog->author->name }}</span>
                            <span class="h-1 w-1 rounded-full bg-orange-200"></span>
                            <span>{{ optional($blog->published_at)->format('d/m/Y H:i') }}</span>
                            <span class="h-1 w-1 rounded-full bg-orange-200"></span>
                            <span>{{ optional($blog->published_at)->diffForHumans() }}</span>
                        </div>
                        <h1 class="mt-4 max-w-4xl text-3xl font-bold leading-tight text-white sm:text-5xl">
                            {{ $blog->title }}
                        </h1>
                        @if ($blog->excerpt)
                            <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-200 sm:text-base">
                                {{ $blog->excerpt }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="grid gap-8 p-6 lg:grid-cols-[minmax(0,1fr)_320px] lg:p-10">
                    <div class="min-w-0">
                        <div
                            class="prose max-w-none prose-headings:text-slate-800 prose-p:text-slate-600 prose-li:text-slate-600 prose-a:text-orange-600">
                            {!! $blog->content !!}
                        </div>
                    </div>

                    <aside class="space-y-6">
                        <div class="rounded-[1.5rem] bg-slate-50 p-6">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-400">Thông tin bài viết
                            </p>
                            <div class="mt-5 space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <span class="text-sm text-slate-500">Tác giả</span>
                                    <span
                                        class="text-right text-sm font-semibold text-slate-700">{{ $blog->author->name }}</span>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <span class="text-sm text-slate-500">Xuất bản</span>
                                    <span
                                        class="text-right text-sm font-semibold text-slate-700">{{ optional($blog->published_at)->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <span class="text-sm text-slate-500">Thời gian</span>
                                    <span
                                        class="text-right text-sm font-semibold text-orange-600">{{ optional($blog->published_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="rounded-[1.5rem] bg-gradient-to-br from-orange-500 to-amber-400 p-6 text-white shadow-xl">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-orange-100">Khám phá thêm</p>
                            <h2 class="mt-3 text-2xl font-bold">Tìm thêm công thức phù hợp cho bữa ăn hôm nay</h2>
                            <p class="mt-3 text-sm leading-6 text-orange-50">Sau khi đọc bài viết, bạn có thể quay lại
                                kho công thức để áp dụng ngay vào thực đơn của mình.</p>
                            <a href="{{ url('/#recipe') }}"
                                class="mt-5 inline-flex items-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-orange-600">
                                Xem công thức
                            </a>
                        </div>
                    </aside>
                </div>
            </article>

            @if ($relatedBlogs->isNotEmpty())
                <section class="mt-12">
                    <div class="mb-6">
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-400">Đọc tiếp</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-800">Bài viết liên quan</h2>
                    </div>

                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach ($relatedBlogs as $item)
                            <a href="{{ route('blogs.show', $item) }}"
                                class="group overflow-hidden rounded-[1.5rem] bg-white shadow-xl shadow-slate-200/60 transition duration-300 hover:-translate-y-1">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $item->thumbnail_path ? asset('storage/' . $item->thumbnail_path) : asset('assets/img/recipe_book.jpg') }}"
                                        alt="{{ $item->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                </div>
                                <div class="p-5">
                                    <div class="text-xs font-semibold uppercase tracking-[0.18em] text-orange-500">
                                        {{ optional($item->published_at)->diffForHumans() }}
                                    </div>
                                    <h3 class="mt-3 text-lg font-bold leading-7 text-slate-800">{{ $item->title }}
                                    </h3>
                                    <p class="mt-3 text-sm leading-6 text-slate-500">
                                        {{ $item->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($item->content), 110) }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
