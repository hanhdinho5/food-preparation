<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">
                Công thức của tôi</li>
            <li class="ml-2 text-sm capitalize leading-normal text-dark" aria-current="page">Chi tiết</li>
        </ol>
        <h6 class="mb-0 font-bold text-dark capitalize">Chi tiết công thức</h6>
    </x-slot>

    <div class="py-12">
        <div class="relative w-full mx-auto">
            <div
                class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-wrap -mx-3 items-center">
                    <div class="flex-none w-auto max-w-full px-3">
                        <img src="{{ asset('storage/' . $recipe->image_path) }}" alt="recipe_image"
                            class="w-28 h-28 object-cover shadow-2xl rounded-xl" />
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full">
                            <h5 class="mb-1 font-bold">{{ $recipe->title }}</h5>
                            @if ($recipe->summary)
                                <p class="text-sm text-gray-500 max-w-xl">{{ $recipe->summary }}</p>
                            @endif
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span
                                    class="bg-gradient-to-tl from-slate-700 to-slate-500 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">{{ $recipe->category }}</span>
                                @if ($recipe->region)
                                    <span
                                        class="bg-gradient-to-tl from-emerald-600 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">{{ $recipe->region->name }}</span>
                                @endif
                                @if ($recipe->dishType)
                                    <span
                                        class="bg-gradient-to-tl from-orange-500 to-yellow-500 px-2.5 text-xs rounded-1.8 py-1.4 inline-block font-bold uppercase text-white">{{ $recipe->dishType->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 mx-auto mt-4 md:w-1/2 lg:w-4/12 md:mt-0">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-gray-50 rounded-xl p-3 text-center"><i class="fa fa-clock-o"></i>
                                <div class="text-sm mt-1">{{ $recipe->cooking_time }} phút nấu</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center"><i
                                    class="fa fa-star text-yellow-500"></i>
                                <div class="text-sm mt-1">{{ number_format($ratingValue ?? 0, 1) }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center"><i class="fa fa-cutlery"></i>
                                <div class="text-sm mt-1">{{ $recipe->servings ?? 'N/A' }} khẩu phần</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center"><i class="fa fa-signal"></i>
                                <div class="text-sm mt-1">{{ $recipe->difficulty ?? 'Chưa cập nhật' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap mt-6 mx-4">
            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                @if ($recipe->ingredientsList->isNotEmpty())
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border mb-4">
                        <div class="flex-auto p-6">
                            <p class="leading-normal uppercase text-sm">Nguyên liệu chính</p>
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($recipe->ingredientsList as $ingredient)
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full bg-slate-100 text-slate-700">{{ $ingredient->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <p class="leading-normal uppercase text-sm">Chi tiết nguyên liệu</p>
                        <div class="flex flex-wrap mt-4">
                            @php
                                $ingredientLines = preg_split('/\r\n|\r|\n/', $recipe->ingredients);
                                $ingredientLines = array_filter(array_map('trim', $ingredientLines));
                            @endphp
                            <ul class="flex flex-col w-full pl-0 mb-0 rounded-lg">
                                @foreach ($ingredientLines as $item)
                                    <li class="relative flex p-4 mb-2 border-0 rounded-xl bg-gray-50">
                                        <div class="flex flex-col">
                                            <h6 class="text-sm leading-normal">{{ $item }}</h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-4 relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <p class="leading-normal text-sm uppercase">Hướng dẫn</p>
                        <div class="flex flex-wrap mt-4">
                            @php
                                $instructionLines = preg_split('/\r\n|\r|\n/', $recipe->instructions);
                                $instructionLines = array_filter(array_map('trim', $instructionLines));
                            @endphp
                            <ul class="flex flex-col w-full pl-0 mb-0 rounded-lg">
                                @foreach ($instructionLines as $index => $step)
                                    <li class="relative flex p-4 mb-2 border-0 rounded-xl bg-gray-50 gap-3">
                                        <div
                                            class="w-7 h-7 rounded-full bg-blue-500 text-white text-xs font-bold flex items-center justify-center">
                                            {{ $index + 1 }}</div>
                                        <div class="flex-1">
                                            <h6 class="text-sm leading-normal">{{ $step }}</h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @if ($recipe->video_url)
                    <div
                        class="mt-4 relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6">
                            <p class="leading-normal text-sm uppercase">Video hướng dẫn</p>
                            <a href="{{ $recipe->video_url }}" target="_blank" rel="noopener noreferrer"
                                class="inline-block mt-4 px-5 py-2 text-sm font-bold text-white bg-red-500 rounded-lg">Mở
                                video hướng dẫn</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:flex-0 md:mt-0">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <div class="text-center space-y-3">
                            <div class="flex justify-between">
                                <p class="leading-normal text-sm opacity-80">Tác giả</p>
                                <div class="font-semibold text-base text-slate-700">{{ $recipe->user->name }}</div>
                            </div>
                            <div class="flex justify-between">
                                <p class="leading-normal text-sm opacity-80">Ngày đăng</p>
                                <p class="font-semibold text-sm">
                                    {{ \Carbon\Carbon::parse($recipe->created_at)->format('d M Y H:i') }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="leading-normal text-sm opacity-80">Sơ chế</p>
                                <p class="font-semibold text-sm">
                                    {{ $recipe->prep_time ? $recipe->prep_time . ' phút' : 'Chưa cập nhật' }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="leading-normal text-sm opacity-80">Trạng thái</p>
                                <p class="font-semibold text-sm">
                                    {{ $recipe->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="leading-normal text-sm opacity-80">Yêu thích</p><label
                                    class="inline-flex items-center cursor-pointer"><input type="checkbox"
                                        id="favorite-toggle" class="sr-only peer"
                                        {{ $isFavorited ?? false ? 'checked' : '' }}>
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="leading-normal text-sm opacity-80">Đánh giá tổng thể</p>
                                        <div class="mt-1 flex items-center gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor"
                                                    class="h-5 w-5" style="color: {{ ($ratingValue ?? 0) >= $i - 0.5 ? '#facc15' : '#d1d5db' }};">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.258 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.22 21.18c-.996.608-2.231-.29-1.96-1.425l1.258-5.273L2.4 10.955c-.887-.76-.415-2.212.75-2.305l5.403-.434 2.235-5.006Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endfor
                                            <span
                                                class="ml-2 text-sm font-semibold text-slate-700">{{ number_format($ratingValue ?? 0, 1) }}/5</span>
                                            <span class="text-xs text-slate-400">({{ $ratingCount }} lượt đánh
                                                giá)</span>
                                        </div>
                                    </div>

                                    <button type="button" onclick="toggleRatingPicker()"
                                        class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 text-xs font-bold text-blue-600 transition hover:bg-blue-100">
                                        Đánh giá của bạn
                                    </button>
                                </div>

                                <div id="rating-picker"
                                    class="hidden rounded-xl border border-gray-100 bg-gray-50 px-3 py-3">
                                    <p class="mb-2 text-xs text-slate-500">
                                        {{ $myRatingValue ? 'Bạn đã đánh giá ' . (int) $myRatingValue . ' sao. Chọn lại để cập nhật.' : 'Chọn số sao bạn muốn gửi cho công thức này.' }}
                                    </p>
                                    <div class="flex items-center gap-1" onmouseleave="resetPersonalRatingPreview()">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button" onclick="saveRating({{ $i }})"
                                                onmouseover="previewPersonalRating({{ $i }})"
                                                class="inline-flex h-8 w-8 items-center justify-center transition-transform duration-200 hover:scale-110"
                                                aria-label="Đánh giá {{ $i }} sao">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" data-rating-star="{{ $i }}"
                                                    class="h-6 w-6" style="color: {{ (int) ($myRatingValue ?? 0) >= $i ? '#facc15' : '#d1d5db' }};">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.258 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.22 21.18c-.996.608-2.231-.29-1.96-1.425l1.258-5.273L2.4 10.955c-.887-.76-.415-2.212.75-2.305l5.403-.434 2.235-5.006Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl mt-4 rounded-2xl bg-clip-border">
                    <div class="flex-auto w-full p-4 text-center">
                        <div class="transition-all duration-200 ease-nav-brand">
                            <h6 class="mb-4 text-md font-bold text-slate-700 capitalize">Muốn xem món khác?</h6>
                            <a href="{{ route('dashboard') }}"
                                class="inline-block w-full px-8 py-2 mb-4 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-slate-700 hover:-translate-y-px">Xem
                                thêm công thức</a>
                        </div>
                    </div>
                </div> --}}

                <section class="bg-white py-8 mt-4 antialiased border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="max-w-2xl mx-auto px-4">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-md font-bold text-slate-700">10 bình luận mới nhất</h2>
                            <span class="text-xs text-slate-400">Thuộc công thức này</span>
                        </div>
                        <div class="mb-6">
                            <div class="py-2 px-4 mb-4 bg-gray-50 rounded-lg rounded-t-lg border border-gray-200">
                                <label for="comment" class="sr-only">Nhập bình luận của bạn</label>
                                <textarea id="body_comment" rows="6" name="content"
                                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none bg-gray-50"
                                    placeholder="Viết bình luận..." required></textarea>
                            </div>
                            <button type="button" onclick="submitComment()"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-bold leading-normal text-center text-white bg-blue-500 rounded-lg">
                                <i class="fa fa-send text-2.8 mr-2"></i>Gửi bình luận
                            </button>
                        </div>

                        <div class="space-y-3 border-t border-gray-100 pt-6">
                            @forelse ($comment as $c)
                                <div
                                    class=" mb-2 flex items-start justify-between gap-4 rounded-xl border border-gray-100 px-4 py-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2 text-sm">
                                            <img src="{{ asset('assets/img/logo.png') }}" alt="avatar tác giả"
                                                class="h-9 w-9 rounded-full object-cover border border-gray-200 shrink-0">
                                            <span class="font-semibold text-slate-700">{{ $c->user->name }}</span>
                                            <span
                                                class="text-xs text-slate-400">{{ $c->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="mt-1 text-sm text-slate-600 break-words">{{ $c->content }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-xl border border-dashed border-gray-200 px-4 py-6 text-center">
                                    <span class="text-sm text-gray-500">Chưa có bình luận nào cho công thức này.</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            const toggle = document.getElementById('favorite-toggle');
            toggle.addEventListener('change', function() {
                const recipeId = {{ $recipe->id }};
                fetch('/favorite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        recipe_id: recipeId
                    })
                }).then(response => response.json()).then(() => location.reload()).catch(error => console.error(
                    'Error:', error));
            });

            function submitComment() {
                const recipeId = {{ $recipe->id }};
                const message = document.getElementById('body_comment').value;
                fetch('{{ route('recipe.comment') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        recipeId: recipeId,
                        content: message
                    })
                }).then(response => response.json()).then(() => location.reload()).catch(error => console.error('Error:',
                    error));
            }

            const initialMyRating = {{ (int) ($myRatingValue ?? 0) }};
            let currentPreviewRating = initialMyRating;
            let selectedPersonalRating = initialMyRating;

            function toggleRatingPicker() {
                const picker = document.getElementById('rating-picker');
                if (!picker) return;
                picker.classList.toggle('hidden');
                renderPersonalRatingStars(currentPreviewRating);
            }

            function renderPersonalRatingStars(rating) {
                document.querySelectorAll('[data-rating-star]').forEach((star) => {
                    const starValue = Number(star.getAttribute('data-rating-star'));
                    star.style.color = starValue <= rating ? '#facc15' : '#d1d5db';
                });
            }

            function previewPersonalRating(rating) {
                currentPreviewRating = rating;
                renderPersonalRatingStars(rating);
            }

            function resetPersonalRatingPreview() {
                currentPreviewRating = selectedPersonalRating;
                renderPersonalRatingStars(selectedPersonalRating);
            }

            renderPersonalRatingStars(selectedPersonalRating);

            function saveRating(val) {
                console.log('Đánh giá');

                selectedPersonalRating = val;
                currentPreviewRating = val;
                renderPersonalRatingStars(val);

                const recipeId = {{ $recipe->id }};
                fetch('{{ route('recipe.rating') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        rating: val,
                        recipe_id: recipeId
                    })
                }).then(response => response.json()).then(() => location.reload()).catch(error => console.error('Error:',
                    error));
            }
        </script>
    @endsection
</x-app-layout>