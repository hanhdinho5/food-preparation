<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">Công thức của tôi</li>
            <li class="ml-2 text-sm capitalize leading-normal text-dark" aria-current="page">Chỉnh sửa</li>
        </ol>
        <h6 class="mb-0 font-bold text-dark capitalize">Cập nhật công thức</h6>
    </x-slot>

    <div class="py-12">
        <form method="post" action="{{ route('recipe.update', $recipe->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap mx-10 mb-6 gap-y-6">
                <div class="w-full max-w-full shrink-0 md:w-8/12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6 space-y-4">
                            <div>
                                <label for="title" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tiêu đề</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $recipe->title) }}" required class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="summary" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Mô tả ngắn</label>
                                <textarea id="summary" name="summary" rows="3" class="focus:shadow-primary-outline text-sm ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">{{ old('summary', $recipe->summary) }}</textarea>
                                @error('summary') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="ingredient_ids" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nguyên liệu chính</label>
                                <select id="ingredient_ids" name="ingredient_ids[]" multiple size="8" class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">
                                    @foreach ($ingredientsCatalog as $ingredient)
                                        <option value="{{ $ingredient->id }}" @selected(collect(old('ingredient_ids', $selectedIngredients))->contains($ingredient->id))>{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="ingredients" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Chi tiết nguyên liệu</label>
                                <textarea id="ingredients" name="ingredients" rows="5" required class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                                @error('ingredients') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="instructions" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Hướng dẫn</label>
                                <textarea id="instructions" name="instructions" rows="6" required class="focus:shadow-primary-outline text-sm ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">{{ old('instructions', $recipe->instructions) }}</textarea>
                                @error('instructions') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-full md:px-3 shrink-0 md:w-4/12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-6 space-y-4">
                            <div>
                                <label for="image" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Hình ảnh mới</label>
                                <input type="file" id="image" name="image" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="prep_time" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Sơ chế</label>
                                    <input type="number" id="prep_time" name="prep_time" min="0" value="{{ old('prep_time', $recipe->prep_time) }}" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="cooking_time" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nấu (phút)</label>
                                    <input type="number" id="cooking_time" name="cooking_time" min="1" value="{{ old('cooking_time', $recipe->cooking_time) }}" required class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="servings" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Khẩu phần</label>
                                    <input type="number" id="servings" name="servings" min="1" value="{{ old('servings', $recipe->servings) }}" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="difficulty" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Độ khó</label>
                                    <select id="difficulty" name="difficulty" class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">
                                        <option value="">Chọn</option>
                                        @foreach ($difficultyOptions as $value => $label)
                                            <option value="{{ $value }}" @selected(old('difficulty', $recipe->difficulty) === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="category" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Phân loại bữa ăn</label>
                                <select id="category" name="category" required class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">
                                    @foreach ($categoryOptions as $value => $label)
                                        <option value="{{ $value }}" @selected(old('category', $recipe->category) === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="region_id" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Vùng miền</label>
                                <select id="region_id" name="region_id" class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">
                                    <option value="">Chọn vùng miền</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" @selected(old('region_id', $recipe->region_id) == $region->id)>{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="dish_type_id" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Loại món</label>
                                <select id="dish_type_id" name="dish_type_id" class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">
                                    <option value="">Chọn loại món</option>
                                    @foreach ($dishTypes as $dishType)
                                        <option value="{{ $dishType->id }}" @selected(old('dish_type_id', $recipe->dish_type_id) == $dishType->id)>{{ $dishType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="video_url" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Liên kết video hướng dẫn</label>
                                <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $recipe->video_url) }}" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 mt-2">
                    <button type="submit" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-sm hover:-translate-y-px">
                        <i class="fa fa-save mr-2"></i>
                        Cập nhật
                    </button>
                    <a href="{{ route('recipe.index') }}" class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-gray-800 bg-transparent border border-gray-800 rounded-lg shadow-md cursor-pointer text-sm hover:-translate-y-px">
                        Hủy
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>