<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">

            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">
                Công thức của tôi
            </li>
        </ol>

        <h6 class="mb-0 font-bold text-dark capitalize">Công thức của tôi</h6>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-wrap mx-10 mb-6">
            <!-- card1 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Tổng công thức
                                    </p>
                                    <h5 class="mb-2 font-bold">{{ count($recipe) }}</h5>
                                    
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                    <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card2 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Bữa sáng
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white">{{ $totalBreakfast }}</h5>
                                   
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                    <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card3 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Bữa trưa
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white">{{ $totalLunch }}</h5>
                                    
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                    <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card4 -->
            <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Bữa tối
                                    </p>
                                    <h5 class="mb-2 font-bold">{{ $totalDinner }}</h5>
                                   
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                    <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- table --}}
        <div class="flex flex-wrap">
            <div class="flex-none w-full">
                <div
                    class="relative flex flex-col min-w-0 p-4 mx-10 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap p-4 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">

                        <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                            <h4 class="font-bold text-lg">Danh sách công thức</h4>
                        </div>

                        <div class="flex-none w-1/2 max-w-full px-3 text-right">
                            <a href="{{ route('recipe.create') }}"
                                class="inline-block px-8 py-2 mb-0 text-sm font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-none cursor-pointer bg-150 active:opacity-85 hover:-translate-y-px tracking-tight-rem bg-x-25 hover:opacity-75">
                                <i class="fa fa-plus text-2.8 mr-2"></i>
                                Tạo công thức mới
                            </a>
                        </div>
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
                                            Ngày tạo
                                        </th>
                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($recipe->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center p-4">
                                                <span class="text-gray-500 text-xs">Không tìm thấy công thức nào.</span>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($recipe as $data)
                                            <tr class="border-y">
                                                <td
                                                    class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2">
                                                        <div>
                                                            <img src="{{ asset('storage/'.$data->image_path) }}"
                                                                class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                                                alt="recipe" />
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm leading-normal font-semibold">{{ $data->title }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    
                                                    @php
                                                        $gradientClass = '';

                                                        switch ($data->category) {
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
                                                        {{ $data->category }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                    <span class="text-xs font-semibold leading-tight text-slate-400">
                                                        @php
                                                            $date = $data->created_at;
                                                            $formattedDate = \Carbon\Carbon::parse($date)->format('d M Y H:i');
                                                        @endphp

                                                        {{ $formattedDate }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent whitespace-nowrap shadow-transparent">
                                                    <a href="{{ route('recipe.show', $data->id) }}"
                                                        class="text-xs font-bold leading-tight text-slate-400 mr-4">
                                                        Xem
                                                    </a>

                                                    <a href="{{ route('recipe.edit', $data->id) }}"
                                                        class="text-xs font-bold leading-tight text-blue-400 mr-4">
                                                        Sửa
                                                    </a>

                                                    <div x-data="{modalIsOpen: false}" class="inline">
                                                        <a x-on:click="modalIsOpen = true" class="cursor-pointer text-xs font-bold leading-tight text-red-400">Xóa bằng Alpine</a>
                                                        
                                                        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                                                            <!-- Modal Dialog -->
                                                            <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg flex-col gap-4 overflow-hidden border border-outline bg-white text-on-surface shadow-xl rounded-2xl">
                                                                <!-- Dialog Header -->
                                                                <div class="flex items-center justify-end bg-surface-alt/60 p-4">
                                                                  
                                                                    <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <!-- Dialog Body -->
                                                                <div class="p-4"> 
                                                                    <h3 class="mb-8 text-lg font-semibold text-gray-500">Bạn có chắc chắn muốn xóa công thức này không?</h3>
                                                                   
                                                                    <form action="{{ route('recipe.destroy', $data->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
        
                                                                        <div class="flex flex-col w-full gap-2">
                                                                            <x-danger-button class="w-full justify-center">Xóa {{ $data->title }}</x-danger-button> 
                                                                            <x-secondary-button type="button" class="w-full justify-center" x-on:click="modalIsOpen = false">Hủy</x-secondary-button>
                                                                               
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- alternative pure js--}}
                                                    <button onclick="openModal({{ $data->id }})" class="cursor-pointer text-xs font-bold leading-tight text-red-400 ml-2">Xóa bằng JS</button>
    
                                                    <div id="deleteModal-{{ $data->id }}" class="fixed inset-0 z-30 hidden flex items-center justify-center p-4 backdrop-blur-md" role="dialog" aria-modal="true">
                                                        <div class="flex max-w-lg flex-col gap-4 overflow-hidden border bg-white shadow-xl rounded-2xl">
                                                            <!-- Dialog Header -->
                                                            <div class="flex items-center justify-end p-4">
                                                                <button onclick="closeModal({{ $data->id }})" aria-label="close modal">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <!-- Dialog Body -->
                                                            <div class="p-4">
                                                                <h3 class="mb-8 text-lg font-semibold text-gray-500">Bạn có chắc chắn muốn xóa công thức này không?</h3>
                                                                
                                                                <form action="{{ route('recipe.destroy', $data->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
    
                                                                    <div class="flex flex-col w-full gap-2">
                                                                        <button type="submit" class="bg-red-500 inline-block w-full px-8 py-2 text-sm font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md hover:shadow-xs hover:-translate-y-px">Xóa {{ $data->title }}</button>
                                                                        <button type="button" class="inline-block w-full px-4 py-2 bg-white border border-gray-300 font-bold text-sm text-gray-700 capitalize transition-all ease-in rounded-lg shadow-md hover:shadow-xs hover:-translate-y-px" onclick="closeModal({{ $data->id }})">Hủy</button>
                                                                    
                                                                    </div>
                                                                </form>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
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
            function openModal(index) {
                document.getElementById('deleteModal-' + index).classList.remove('hidden');
            }

            function closeModal(index) {
                document.getElementById('deleteModal-' + index).classList.add('hidden');
            }
        </script>
    @endsection
</x-app-layout>
