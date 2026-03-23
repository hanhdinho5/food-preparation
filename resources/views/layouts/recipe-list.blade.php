@if ($recipe->isNotEmpty())
    <div class="flex flex-wrap -mx-2">
        @foreach ($recipe as $data)
            <div class="w-1/2 px-2 mb-4">
                <a href="{{ route('recipe.show', $data->id) }}"
                    class="block bg-white rounded-xl shadow-md overflow-hidden hover:-translate-y-1 transition duration-200">

                    <!-- Image -->
                    <img class="w-full h-[160px] object-cover" src="{{ asset('storage/' . $data->image_path) }}"
                        alt="recipe">

                    <!-- Content -->
                    <div class="p-4 text-center">
                        <!-- Category -->
                        <span
                            class="inline-block mb-2 px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                            {{ $data->category }}
                        </span>

                        <!-- Title -->
                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-2">
                            {{ $data->title }}
                        </h3>

                        <!-- Info -->
                        <div class="flex justify-center gap-3 text-xs text-gray-500 mt-2">
                            <span><i class="fa fa-clock-o"></i> {{ $data->cooking_time }}p</span>
                            <span><i class="fa fa-star text-yellow-500"></i>
                                {{ number_format($data->ratings()->avg('score') ?? 0, 1) }}
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@else
    <span class="text-gray-500 text-sm">Không tìm thấy công thức nào.</span>
@endif

@if (request()->routeIs('dashboard'))
    <div class="mt-4">
        {{ $recipe->links() }}
    </div>
@endif
