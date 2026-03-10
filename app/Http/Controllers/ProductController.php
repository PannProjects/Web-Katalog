<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['comments.user', 'user']);

        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photo' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        $path = $request->file('photo')->store('products', 'public');

        Product::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'photo' => $path,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($product->photo);
            $path = $request->file('photo')->store('products', 'public');
            $product->photo = $path;
        }

        $product->title = $validated['title'];
        $product->description = $validated['description'];
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->photo);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function adminIndex()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }
}
