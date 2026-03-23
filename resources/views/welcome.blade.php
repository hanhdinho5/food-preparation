<x-app-layout>
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

    <div class="relative w-full mx-auto pt-36">
        {{-- about section --}}
        <section id="about_us" class="pt-10 pb-24 relative mx-6">
            <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                <div class="w-full justify-start items-center xl:gap-12 gap-10 grid lg:grid-cols-2 grid-cols-1">
                    <div class="w-full flex-col justify-center lg:items-start items-center gap-10 inline-flex">
                        <div class="w-full flex-col justify-center items-start gap-8 flex">
                            <div class="flex-col justify-start lg:items-start items-center gap-4 flex">
                                <div class="w-full flex-col justify-start lg:items-start items-center gap-3 flex">
                                    <h2
                                        class="text-indigo-700 text-2xl font-bold font-manrope leading-normal lg:text-start text-center">
                                        Khám phá những công thức nấu ăn hấp dẫn
                                    </h2>
                                    <p
                                        class="text-gray-500 text-base font-normal leading-relaxed lg:text-start text-center">
                                        Tham gia cộng đồng yêu ẩm thực và chia sẻ những món ăn yêu thích của bạn với mọi
                                        người.
                                    </p>
                                </div>
                            </div>
                            <div class="w-full flex-col justify-center items-start gap-6 flex">
                                <div class="w-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                                    <div
                                        class="w-full h-full p-3.5 rounded-xl border border-gray-200 hover:border-gray-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex">
                                        <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">1+ Năm
                                        </h4>
                                        <p class="text-gray-500 text-base font-normal leading-relaxed">
                                            Hoạt động
                                        </p>
                                    </div>
                                    <div
                                        class="w-full h-full p-3.5 rounded-xl border border-gray-200 hover:border-gray-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex">
                                        <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">
                                            {{ $totalUsers }} Người dùng
                                        </h4>
                                        <p class="text-gray-500 text-base font-normal leading-relaxed">
                                            Tham gia
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="w-full h-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                                    <div
                                        class="w-full p-3.5 rounded-xl border border-gray-200 hover:border-gray-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex">
                                        <h4 class="text-gray-900 text-2xl font-bold font-manrope leading-9">
                                            {{ $totalRecipes }} Công thức</h4>
                                        <p class="text-gray-500 text-base font-normal leading-relaxed">
                                            Đã đăng
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:justify-start justify-center items-start flex">
                        <div
                            class="sm:w-[564px] w-full sm:h-[646px] h-full sm:bg-gray-100 rounded-3xl sm:border border-gray-200 relative">
                            <img class="sm:mt-5 sm:ml-5 w-full h-full rounded-3xl object-cover"
                                src="{{ asset('assets/img/recipe_book.jpg') }}" alt="hinh_gioi_thieu" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- end about section --}}

        {{-- recipe section --}}
        <div id="recipe" class="py-24 flex flex-col items-center">
            <h4 class="font-bold text-2xl mb-3">Công thức phổ biến nhất</h4>
            <p class="mb-4">Khám phá nhiều món ăn hấp dẫn được chia sẻ bởi cộng đồng.</p>

            {{-- card --}}
            <div class="flex flex-wrap p-4 mx-6">
                @include('layouts.recipe-list', ['recipe' => $recipe])
            </div>

            <a href="{{ route('dashboard') }}"
                class="block px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-sm bg-gray-800 tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                Xem thêm
            </a>
        </div>
        {{-- end recipe section --}}

        {{-- join section --}}
        <section id="how_to_join" class="py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-14 text-center">
                    <h2 class="text-2xl text-center font-bold text-gray-900 py-5">
                        Tham gia cộng đồng thật dễ dàng và hoàn toàn miễn phí!
                    </h2>
                    <p class="font-normal text-gray-500 max-w-md md:max-w-2xl mx-auto">
                        Làm theo các bước đơn giản sau để bắt đầu.
                    </p>
                </div>
                <div
                    class="flex justify-center items-center gap-x-5 gap-y-8 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:gap-x-8">
                    <div class="relative w-full text-center max-md:max-w-sm max-md:mx-auto group md:w-2/5 lg:w-1/4">
                        <div
                            class="bg-indigo-50 rounded-lg flex justify-center items-center mb-5 w-20 h-20 mx-auto cursor-pointer transition-all duration-500 group-hover:bg-indigo-600">

                            <svg class="stroke-indigo-600 transition-all duration-500 group-hover:stroke-white"
                                width="60" height="60" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-3 capitalize">
                            Đăng ký
                        </h4>
                        <p class="text-sm font-normal text-gray-500">
                            Tạo tài khoản miễn phí bằng cách điền thông tin vào form đăng ký.
                        </p>
                    </div>
                    <div class="relative w-full text-center max-md:max-w-sm max-md:mx-auto group md:w-2/5 lg:w-1/4">
                        <div
                            class="bg-pink-50 rounded-lg flex justify-center items-center mb-5 w-20 h-20 mx-auto cursor-pointer transition-all duration-500 group-hover:bg-pink-600">

                            <svg class="stroke-pink-600 transition-all duration-500 group-hover:stroke-white"
                                width="60" height="60" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>

                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-3 capitalize">
                            Chia sẻ công thức
                        </h4>
                        <p class="text-sm font-normal text-gray-500">
                            Bắt đầu đăng các công thức yêu thích của bạn và kết nối với những người cùng đam mê ẩm thực!
                        </p>
                    </div>

                </div>
            </div>
        </section>
        {{-- end join section --}}
    </div>
</x-app-layout>
