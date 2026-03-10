@extends('layouts.app')

@section('title', 'Tambah Produk — Web Katalog')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 transition mb-6">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Dashboard
    </a>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Produk</h1>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                    placeholder="Masukkan nama produk"
                >
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    required
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                    placeholder="Deskripsikan produk Anda"
                >{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto Produk</label>
                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/jpeg,image/jpg,image/png,image/webp"
                    required
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 file:transition file:cursor-pointer"
                >
                <p class="text-xs text-gray-400 mt-1">Format: JPEG, PNG, WebP. Maksimal 2MB.</p>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-gray-900 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 active:bg-gray-950 transition cursor-pointer">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
