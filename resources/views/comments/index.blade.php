<x-app-layout>
    <x-slot name="header">
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm capitalize leading-normal text-dark after:ml-2 after:content-['/']" aria-current="page">
                Bình luận của tôi
            </li>
        </ol>

        <h6 class="mb-0 font-bold text-dark capitalize">Bình luận của tôi</h6>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-wrap">
            <div class="flex-none w-full">
                <div class="relative flex flex-col min-w-0 p-4 mx-10 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex flex-wrap items-center justify-between p-4 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent gap-3">
                        <div>
                            <h4 class="font-bold text-lg">Danh sách bình luận</h4>
                            <p class="text-sm text-gray-500">Theo dõi toàn bộ bình luận bạn đã gửi trên các công thức.</p>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-600">
                            Tổng cộng: {{ $comments->total() }} bình luận
                        </span>
                    </div>

                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Công thức
                                        </th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Nội dung bình luận
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Thời gian
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($comments as $comment)
                                        <tr class="border-y">
                                            <td class="p-4 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                <div class="flex flex-col">
                                                    <h6 class="mb-1 text-sm leading-normal font-semibold text-slate-700">
                                                        {{ $comment->recipe?->title ?? 'Công thức không còn tồn tại' }}
                                                    </h6>
                                                    <span class="text-xs text-slate-400">
                                                        Tác giả: {{ $comment->recipe?->user?->name ?? 'Không xác định' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="p-4 align-middle bg-transparent shadow-transparent">
                                                <p class="text-sm leading-6 text-slate-600 whitespace-normal max-w-xl">
                                                    {{ $comment->content }}
                                                </p>
                                            </td>
                                            <td class="p-4 text-center align-middle bg-transparent whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight text-slate-400">
                                                    {{ $comment->created_at?->format('d/m/Y H:i') }}
                                                </span>
                                            </td>
                                            <td class="p-4 align-middle text-center bg-transparent whitespace-nowrap shadow-transparent">
                                                @if ($comment->recipe)
                                                    <a href="{{ route('recipe.show', $comment->recipe->id) }}"
                                                        class="text-xs font-bold leading-tight text-blue-500">
                                                        Xem công thức
                                                    </a>
                                                @else
                                                    <span class="text-xs font-semibold leading-tight text-slate-300">Không khả dụng</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-8">
                                                <span class="text-gray-500 text-sm">Bạn chưa có bình luận nào.</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($comments->hasPages())
                            <div class="px-6 pt-4">
                                {{ $comments->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>