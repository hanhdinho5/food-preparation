<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">
                Bảng điều khiển</li>
        </ol>
        <h6 class="mb-0 font-bold text-dark capitalize">Bảng điều khiển</h6>
    </x-slot>

    <div class="py-12">
        <div class="relative w-full">
            <div
                class="flex flex-col flex-auto p-4 mx-10 overflow-hidden break-words bg-white border-0 shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-col items-center">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                            <img src="{{ asset('assets/img/recipe_book.jpg') }}" alt="anh_chinh"
                                class="w-full shadow-2xl rounded-xl" />
                        </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full text-center">
                            <h5 class="mb-1 text-lg font-bold">Biến nguyên liệu thành cảm hứng</h5>
                            <p class="mb-0 font-semibold leading-normal text-sm">Hãy thỏa sức sáng tạo! Tìm, lọc và khám
                                phá món ăn theo đúng nguyên liệu bạn đang có.</p>
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 mx-auto mt-6">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('recipe.create') }}"
                                class="hidden px-8 py-2 font-bold leading-normal text-center text-white transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-sm bg-blue-500 lg:block hover:-translate-y-px active:opacity-85"><i
                                    class="fa fa-plus text-2.8 mr-2"></i>Tạo công thức mới</a>
                            <a href="{{ route('recipe.index') }}"
                                class="hidden px-8 py-2 font-bold leading-normal text-center text-white transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-sm bg-gray-800 lg:block hover:-translate-y-px active:opacity-85">Xem
                                công thức của tôi</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 pt-12 pb-4 flex flex-col items-center">
                <h4 class="font-bold text-lg">Khám phá công thức</h4>
                <p class="mb-6">Tìm món ăn theo vùng miền, nguyên liệu, độ khó hoặc dùng chế độ gợi ý theo nguyên liệu
                    sẵn có.</p>

                <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl p-6">
                    <form action="{{ route('dashboard') }}" method="GET" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-4 items-end">
                            <div class="xl:col-span-2">
                                <label for="search" class="block mb-2 text-xs font-bold text-slate-700">Từ
                                    khóa</label>
                                <input id="search" type="text" name="search" value="{{ request('search') }}"
                                    class="pl-4 text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 pr-3 text-gray-700 focus:border-blue-500 focus:outline-none"
                                    placeholder="Tên món, tác giả, nguyên liệu..." />
                            </div>
                            <div>
                                <label for="region" class="block mb-2 text-xs font-bold text-slate-700">Vùng
                                    miền</label>
                                <select id="region" name="region"
                                    class="text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 focus:border-blue-500 focus:outline-none">
                                    <option value="">Tất cả</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" @selected((string) request('region') === (string) $region->id)>
                                            {{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="dish_type" class="block mb-2 text-xs font-bold text-slate-700">Loại
                                    món</label>
                                <select id="dish_type" name="dish_type"
                                    class="text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 focus:border-blue-500 focus:outline-none">
                                    <option value="">Tất cả</option>
                                    @foreach ($dishTypes as $dishType)
                                        <option value="{{ $dishType->id }}" @selected((string) request('dish_type') === (string) $dishType->id)>
                                            {{ $dishType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="ingredient" class="block mb-2 text-xs font-bold text-slate-700">Lọc nhanh
                                    theo nguyên liệu</label>
                                <select id="ingredient" name="ingredient"
                                    class="text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 focus:border-blue-500 focus:outline-none">
                                    <option value="">Tất cả</option>
                                    @foreach ($ingredientsCatalog as $ingredient)
                                        <option value="{{ $ingredient->id }}" @selected((string) request('ingredient') === (string) $ingredient->id)>
                                            {{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="sort" class="block mb-2 text-xs font-bold text-slate-700">Sắp
                                    xếp</label>
                                <select id="sort" name="sort"
                                    class="text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 focus:border-blue-500 focus:outline-none">
                                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Mới nhất</option>
                                    <option value="rating" @selected(request('sort') === 'rating')>Đánh giá cao</option>
                                    <option value="popular" @selected(request('sort') === 'popular')>Được yêu thích</option>
                                    <option value="time_asc" @selected(request('sort') === 'time_asc')>Nấu nhanh nhất</option>
                                </select>
                            </div>
                            <div>
                                <label for="difficulty" class="block mb-2 text-xs font-bold text-slate-700">Độ
                                    khó</label>
                                <select id="difficulty" name="difficulty"
                                    class="text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 focus:border-blue-500 focus:outline-none">
                                    <option value="">Tất cả</option>
                                    @foreach ($difficultyOptions as $difficulty)
                                        <option value="{{ $difficulty }}" @selected(request('difficulty') === $difficulty)>
                                            {{ $difficulty }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="border border-dashed border-blue-200 rounded-2xl p-4 bg-blue-50/40">
                            <div class="flex flex-col gap-3">
                                <div>
                                    <h5 class="font-bold text-slate-800">Gợi ý món ăn theo nguyên liệu sẵn có</h5>
                                    <p class="text-sm text-gray-500">Chọn nhiều nguyên liệu bạn đang có, hệ thống sẽ ưu
                                        tiên những món khớp nhiều nguyên liệu nhất.</p>
                                </div>
                                <select name="available_ingredients[]" multiple size="6"
                                    class="text-sm block w-full rounded-lg border border-solid border-gray-300 bg-white py-2 px-3 text-gray-700 focus:border-blue-500 focus:outline-none">
                                    @foreach ($ingredientsCatalog as $ingredient)
                                        <option value="{{ $ingredient->id }}" @selected(collect($selectedAvailableIngredients)->contains($ingredient->id))>
                                            {{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500">Giữ Ctrl hoặc Command để chọn nhiều nguyên liệu cùng
                                    lúc.</p>
                            </div>
                        </div>

                        <div class="flex gap-3 justify-end">
                            <a href="{{ route('dashboard') }}"
                                class="px-5 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-lg">Đặt
                                lại</a>
                            <button type="submit"
                                class="px-5 py-2 text-sm font-bold text-white bg-blue-500 rounded-lg">Lọc và gợi ý công
                                thức</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="search-results" class="flex flex-wrap p-4 mx-6 justify-center">
                @include('layouts.recipe-list', ['recipe' => $recipe])
            </div>
        </div>
    </div>
</x-app-layout>
