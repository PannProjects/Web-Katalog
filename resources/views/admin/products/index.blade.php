@extends('layouts.app')

@section('title', 'Dashboard Produk — Web Katalog')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Produk</h1>
            <p class="text-gray-500 text-sm mt-1">Tambah, edit, dan hapus foto produk</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
            + Tambah Produk
        </a>
    </div>

    @if($products->count())
        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Produk</th>
                            <th class="text-left px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider hidden sm:table-cell">Tanggal</th>
                            <th class="text-right px-6 py-4 font-semibold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img
                                            src="{{ asset('storage/' . $product->photo) }}"
                                            alt="{{ $product->title }}"
                                            class="w-12 h-12 rounded-lg object-cover bg-gray-100 shrink-0"
                                        >
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 truncate">{{ $product->title }}</p>
                                            <p class="text-gray-400 text-xs truncate mt-0.5">{{ Str::limit($product->description, 60) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 hidden sm:table-cell whitespace-nowrap">
                                    {{ $product->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('products.show', $product) }}" class="text-gray-400 hover:text-gray-700 transition" title="Lihat">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="text-gray-400 hover:text-blue-600 transition" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition cursor-pointer" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-white border border-gray-100 rounded-2xl">
            <div class="text-6xl mb-4">📦</div>
            <h2 class="text-xl font-semibold text-gray-900">Belum ada produk</h2>
            <p class="text-gray-500 mt-1 mb-6">Mulai tambahkan produk pertama Anda</p>
            <a href="{{ route('admin.products.create') }}" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                + Tambah Produk
            </a>
        </div>
    @endif
</div>
@endsection
