<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">Bài viết của tôi</li>
            <li class="ml-2 text-sm capitalize leading-normal text-dark" aria-current="page">Tạo mới</li>
        </ol>
        <h6 class="mb-0 font-bold text-dark capitalize">Tạo bài viết</h6>
    </x-slot>

    <div class="py-12">
        <form method="post" action="{{ route('my-blogs.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-wrap mx-10 mb-6 gap-y-6">
                <div class="w-full max-w-full shrink-0 md:w-8/12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6 space-y-4">
                            <div>
                                <label for="title" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tiêu đề</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="excerpt" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Mô tả ngắn</label>
                                <textarea id="excerpt" name="excerpt" rows="3" class="focus:shadow-primary-outline text-sm ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">{{ old('excerpt') }}</textarea>
                                @error('excerpt') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="content" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nội dung bài viết</label>
                                <textarea id="content" name="content" rows="16" required class="focus:shadow-primary-outline text-sm ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">{{ old('content') }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Bạn có thể nhập nội dung dạng văn bản thường. Hệ thống sẽ tự xuống dòng khi hiển thị.</p>
                                @error('content') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6 space-y-4">
                            <div>
                                <label for="thumbnail" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Ảnh đại diện</label>
                                <input type="file" id="thumbnail" name="thumbnail" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                @error('thumbnail') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                                <p class="font-bold text-slate-700">Trạng thái khi tạo</p>
                                <p class="mt-2">Nếu tài khoản của bạn không phải admin, bài viết mới sẽ được lưu ở trạng thái <span class="font-semibold">chưa xuất bản</span>.</p>
                                <p class="mt-2">Admin tạo bài viết sẽ được xuất bản ngay.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mt-2">
                    <button type="submit" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-sm hover:-translate-y-px">
                        <i class="fa fa-save mr-2"></i>
                        Lưu bài viết
                    </button>
                    <a href="{{ route('my-blogs.index') }}" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-gray-800 bg-transparent border border-gray-800 rounded-lg shadow-md cursor-pointer text-sm hover:-translate-y-px">
                        Hủy
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>