<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">

            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">
                Công thức yêu thích
            </li>
        </ol>

        <h6 class="mb-0 font-bold text-dark capitalize">Công thức yêu thích</h6>
    </x-slot>

    <div class="py-12">
        {{-- table --}}
        <div class="flex flex-wrap">
            <div class="flex-none w-full">
                <div class="relative flex flex-col min-w-0 p-4 mx-10 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-4 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h4 class="font-bold text-lg">Công thức yêu thích</h4>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Tiêu đề
                                        </th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Danh mục
                                        </th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Tác giả
                                        </th>
                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($favorite_recipe->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center p-4">
                                                <span class="text-gray-500 text-xs">Không có công thức yêu thích nào.</span>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($favorite_recipe as $recipe)
                                            <tr class="border-y">
                                                <td
                                                    class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2">
                                                        <div>
                                                            <img src="{{ asset('storage/'.$recipe->image_path) }}"
                                                                class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                                                alt="recipe" />
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm leading-normal font-semibold">
                                                                {{ $recipe->title }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    
                                                    @php
                                                        $gradientClass = '';
                        
                                                        switch ($recipe->category) {
                                                            case 'breakfast':
                                                                $gradientClass = 'from-emerald-600 to-teal-300';
                                                                break;
                                                            case 'lunch':
                                                                $gradientClass = 'from-orange-600 to-orange-300';
                                                                break;
                                                            default:
                                                                $gradientClass = 'from-gray-600 to-gray-300'; // Default case if needed
                                                                break;
                                                        }
                                                    @endphp

                                                    <span
                                                        class="bg-gradient-to-tl {{ $gradientClass }} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                        {{ $recipe->category }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    <span class="text-xs font-semibold leading-tight text-slate-400">
                                                        {{ $recipe->user->name }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent whitespace-nowrap shadow-transparent">
                                                    <a href="{{ route('recipe.show', $recipe->id) }}"
                                                        class="text-xs font-semibold leading-tight text-slate-400 mr-4">
                                                        Xem
                                                    </a>

                                                    <a href="#" data-recipe-id="{{ $recipe->id }}"
                                                        class="favorite-btn text-xs font-semibold leading-tight text-red-400">
                                                        Bỏ thích
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            const favoriteLinks = document.querySelectorAll('.favorite-btn');

            favoriteLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior

                    const recipeId = this.getAttribute('data-recipe-id');

                    // Send the favorite toggle request to the server
                    fetch('/favorite', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ recipe_id: recipeId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                    
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        console.log('failed')
                    });
                });
            })
        </script>
    @endsection
</x-app-layout>