@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-6">
    {{-- Breadcrumb --}}
    <nav class="text-sm mb-6" aria-label="Breadcrumb">
        <ol class="flex text-gray-500 space-x-2">
            <li>
                <a href="{{ route('produk.index') }}" class="hover:text-primary hover:underline transition">
                    <i class="fas fa-box-open mr-1"></i> Produk
                </a>
            </li>
            <li>/</li>
            <li class="text-gray-800 font-semibold">Edit Produk</li>
        </ol>
    </nav>

    {{-- Judul --}}
    <h1 class="text-3xl font-extrabold text-highlight mb-8 flex items-center gap-3">
        <i class="fa-solid fa-pen-to-square text-accent"></i>
        Edit Produk
    </h1>

    {{-- Form --}}
    <div class="bg-white shadow-xl rounded-2xl p-8 ring-1 ring-gray-200 space-y-6 animate-fade-in-down">
        <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @method('PUT')
            @include('admin.produk._form', ['submit' => 'Update Produk', 'produk' => $produk])

            <div class="flex justify-end">
                <a href="{{ route('produk.index') }}"
                   class="mr-4 px-6 py-2 text-sm rounded-xl font-semibold border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-highlight hover:bg-primary text-white px-6 py-2 text-sm rounded-xl font-semibold shadow-md transition">
                    <i class="fas fa-save"></i> {{ $submit ?? 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection