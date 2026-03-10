@extends('layouts.app')

@section('title', 'Katalog Produk — Web Katalog')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">Katalog Produk</h1>
        <p class="text-gray-500 mt-1">Jelajahi koleksi produk terbaru kami</p>
    </div>

    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                        <img
                            src="{{ asset('storage/' . $product->photo) }}"
                            alt="{{ $product->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                    </div>
                    <div class="p-5">
                        <h2 class="font-semibold text-gray-900 text-lg group-hover:text-gray-700 transition">{{ $product->title }}</h2>
                        <p class="text-gray-500 text-sm mt-1.5 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex items-center gap-2 mt-3 text-xs text-gray-400">
                            <span>{{ $product->user->name }}</span>
                            <span>&middot;</span>
                            <span>{{ $product->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <div class="text-6xl mb-4">📷</div>
            <h2 class="text-xl font-semibold text-gray-900">Belum ada produk</h2>
            <p class="text-gray-500 mt-1">Produk akan muncul di sini setelah ditambahkan oleh admin</p>
        </div>
    @endif
</div>
@endsection
