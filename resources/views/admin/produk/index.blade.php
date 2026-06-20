@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-4xl font-extrabold mb-8 text-primary border-b pb-4 flex items-center gap-3">
        <i class="fa-solid fa-boxes-stacked text-primary"></i>
        Kelola Produk
    </h1>

    <a href="{{ route('produk.create') }}" 
       class="inline-flex items-center gap-2 mb-8 bg-primary hover:bg-highlight text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg">
        <i class="fa-solid fa-plus"></i> Tambah Produk
    </a>

    @if(session('success'))
        <div class="mb-6 p-4 bg-soft border border-highlight text-primary rounded-xl shadow-sm flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-2xl shadow-xl ring-1 ring-gray-200">
        <table class="w-full text-sm text-gray-700">
            <thead class="bg-soft text-left text-sm font-bold text-gray-700 uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-4">Gambar</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $p)
                    <tr class="border-t hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">
                            @if ($p->gambar)
                                <img src="{{ asset('storage/products/' . $p->gambar) }}"
                                     alt="{{ $p->nama }}"
                                     class="w-20 h-20 object-cover rounded-lg border border-gray-300 shadow-sm hover:scale-105 transition duration-200">
                            @else
                                <span class="text-gray-400 italic">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $p->nama }}
                        </td>
                        <td class="px-6 py-4 text-primary font-bold">
                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{ route('produk.edit', $p) }}"
                                   class="text-accent hover:text-highlight transform hover:scale-110 transition"
                                   title="Edit Produk">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>
                                <form action="{{ route('produk.destroy', $p) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin hapus produk ini?');"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 transform hover:scale-110 transition"
                                            title="Hapus Produk">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <i class="fa-regular fa-folder-open text-3xl text-gray-400"></i>
                                <span class="italic">Belum ada produk ditambahkan.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection