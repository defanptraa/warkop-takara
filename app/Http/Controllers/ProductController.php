<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // User: tampilkan menu produk
    public function menu()
    {
        $products = Product::all();
        return view('user.menu', compact('products'));
    }

    // Admin: daftar produk
    public function index()
    {
        $produk = Product::latest()->get();
        return view('admin.produk.index', compact('produk'));
    }

    // Admin: tampilkan form tambah produk
    public function create()
    {
        return view('admin.produk.create');
    }

    // Admin: simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nama', 'harga');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $stored = Storage::disk('public')->putFileAs('products', $file, $filename);

            if (!Storage::disk('public')->exists('products/' . $filename)) {
                return back()->with('error', 'File tidak ditemukan setelah upload.');
            }

            if (!$stored) {
                return back()->with('error', 'Gagal menyimpan gambar.');
            }

            $data['gambar'] = $filename;
        }

        Product::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Admin: form edit produk
    public function edit(Product $produk)
    {
        return view('admin.produk.edit', compact('produk'));
    }

    // Admin: update produk
    public function update(Request $request, Product $produk)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('nama', 'harga');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $stored = Storage::disk('public')->putFileAs('products', $file, $filename);
            if (!Storage::disk('public')->exists('products/' . $filename)) {
                return back()->with('error', 'File tidak ditemukan setelah upload.');
            }
            if (!$stored) {
                return back()->with('error', 'Gagal menyimpan gambar.');
            }

            $data['gambar'] = $filename;
        }
        
        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    // Admin: hapus produk
    public function destroy(Product $produk)
    {
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
