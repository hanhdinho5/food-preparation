<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">
                Bài viết của tôi
            </li>
        </ol>
        <h6 class="mb-0 font-bold text-dark capitalize">Bài viết của tôi</h6>
    </x-slot>

    <div class="py-12">
        <div class="flex gap-4 mx-10 mb-6 flex-wrap">

            <!-- Card 1 -->
            <div class="flex-1 min-w-[220px] max-w-xs">
                <div class="flex items-center justify-between p-4 bg-white shadow-xl rounded-2xl">

                    <div>
                        <p class="text-sm font-semibold uppercase text-gray-500">Tổng bài viết</p>
                        <h5 class="text-xl font-bold">{{ $blogs->count() }}</h5>
                    </div>

                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-amber-500 to-orange-500">
                        <i class="fa fa-newspaper-o text-white"></i>
                    </div>

                </div>
            </div>

            <!-- Card 2 -->
            <div class="flex-1 min-w-[220px] max-w-xs">
                <div class="flex items-center justify-between p-4 bg-white shadow-xl rounded-2xl">

                    <div>
                        <p class="text-sm font-semibold uppercase text-gray-500">Đã xuất bản</p>
                        <h5 class="text-xl font-bold">{{ $publishedCount }}</h5>
                    </div>

                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-emerald-500 to-teal-400">
                        <i class="fa fa-check text-white"></i>
                    </div>

                </div>
            </div>

            <!-- Card 3 -->
            <div class="flex-1 min-w-[220px] max-w-xs">
                <div class="flex items-center justify-between p-4 bg-white shadow-xl rounded-2xl">

                    <div>
                        <p class="text-sm font-semibold uppercase text-gray-500">Chưa xuất bản</p>
                        <h5 class="text-xl font-bold">{{ $unpublishedCount }}</h5>
                    </div>

                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-slate-600 to-slate-400">
                        <i class="fa fa-clock-o text-white"></i>
                    </div>

                </div>
            </div>

        </div>


        <div class="flex flex-wrap">
            <div class="flex-none w-full">
                <div
                    class="relative flex flex-col min-w-0 p-4 mx-10 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap p-4 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                            <h4 class="font-bold text-lg">Danh sách bài viết</h4>
                        </div>

                        <div class="flex-none w-1/2 max-w-full px-3 text-right">
                            <a href="{{ route('my-blogs.create') }}"
                                class="inline-block px-8 py-2 mb-0 text-sm font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px">
                                <i class="fa fa-plus text-2.8 mr-2"></i>
                                Tạo bài viết mới
                            </a>
                        </div>
                    </div>

                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">
                                            Tiêu đề</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">
                                            Trạng thái</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b text-xxs whitespace-nowrap text-slate-400 opacity-70">
                                            Ngày tạo</th>
                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blogs as $blog)
                                        <tr class="border-y">
                                            <td
                                                class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 items-center">
                                                    <div>
                                                        <img src="{{ $blog->thumbnail_path ? asset('storage/' . $blog->thumbnail_path) : asset('assets/img/recipe_book.jpg') }}"
                                                            class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-12 w-12 rounded-xl object-cover"
                                                            alt="blog" />
                                                    </div>
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm leading-normal font-semibold">
                                                            {{ $blog->title }}</h6>
                                                        <p class="mb-0 text-xs text-slate-400">
                                                            {{ $blog->excerpt ? \Illuminate\Support\Str::limit($blog->excerpt, 70) : 'Chưa có mô tả ngắn.' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 text-sm leading-normal text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                <span
                                                    class="px-2.5 py-1.5 text-xs rounded-full font-bold {{ $blog->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                                    {{ $blog->status === 'published' ? 'Đã xuất bản' : 'Chưa xuất bản' }}
                                                </span>
                                            </td>
                                            <td
                                                class="p-2 text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight text-slate-400">
                                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d/m/Y H:i') }}
                                                </span>
                                            </td>
                                            <td
                                                class="p-2 align-middle text-center bg-transparent whitespace-nowrap shadow-transparent">
                                                @if ($blog->status === 'published')
                                                    <a href="{{ route('blogs.show', $blog) }}"
                                                        class="text-xs font-bold leading-tight text-slate-400 mr-4">
                                                        Xem
                                                    </a>
                                                @else
                                                    <span
                                                        class="text-xs font-bold leading-tight text-slate-300 mr-4">Xem</span>
                                                @endif

                                                <form action="{{ route('my-blogs.destroy', $blog) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-xs font-bold leading-tight text-red-400">
                                                        Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-4">
                                                <span class="text-gray-500 text-xs">Không tìm thấy bài viết nào.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
