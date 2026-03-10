@extends('layouts.app')

@section('title', $product->title . ' — Web Katalog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 transition mb-6">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Katalog
    </a>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="aspect-[16/9] overflow-hidden bg-gray-100">
            <img
                src="{{ asset('storage/' . $product->photo) }}"
                alt="{{ $product->title }}"
                class="w-full h-full object-cover"
            >
        </div>
        <div class="p-6 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
            <div class="flex items-center gap-2 mt-2 text-sm text-gray-400">
                <span>{{ $product->user->name }}</span>
                <span>&middot;</span>
                <span>{{ $product->created_at->translatedFormat('d F Y') }}</span>
            </div>
            <div class="mt-6 text-gray-700 leading-relaxed whitespace-pre-line">{{ $product->description }}</div>
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-lg font-semibold text-gray-900 mb-6">
            Komentar ({{ $product->comments->count() }})
        </h2>

        @auth
            <form method="POST" action="{{ route('comments.store', $product) }}" class="mb-8">
                @csrf
                <textarea
                    name="body"
                    rows="3"
                    required
                    maxlength="1000"
                    placeholder="Tulis komentar Anda..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 resize-none focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                >{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="flex justify-end mt-3">
                    <button type="submit" class="bg-gray-900 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition cursor-pointer">
                        Kirim Komentar
                    </button>
                </div>
            </form>
        @else
            <div class="bg-gray-50 border border-gray-100 rounded-xl p-4 mb-8 text-center">
                <p class="text-sm text-gray-500">
                    <a href="{{ route('login') }}" class="text-gray-900 font-semibold hover:underline">Masuk</a>
                    untuk menambahkan komentar.
                </p>
            </div>
        @endauth

        <div class="space-y-4">
            @forelse($product->comments->sortByDesc('created_at') as $comment)
                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="font-semibold text-sm text-gray-900">{{ $comment->user->name }}</span>
                            @if($comment->user->isAdmin())
                                <span class="ml-1.5 text-xs bg-gray-900 text-white px-2 py-0.5 rounded-full">Admin</span>
                            @endif
                            <span class="text-xs text-gray-400 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        @auth
                            @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" onsubmit="return confirm('Hapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 transition cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                    <p class="text-gray-700 text-sm mt-2 leading-relaxed">{{ $comment->body }}</p>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-gray-400 text-sm">Belum ada komentar. Jadilah yang pertama!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
