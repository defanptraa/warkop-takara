@csrf
<div class="mb-4">
    <label class="block font-semibold mb-1">Nama Produk</label>
    <input type="text" name="nama" value="{{ old('nama', $produk->nama ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('nama')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-1">Harga</label>
    <input type="number" name="harga" value="{{ old('harga', $produk->harga ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('harga')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-1">Gambar Produk</label>
    <input type="file" name="gambar" accept="image/*" class="w-full border rounded px-3 py-2">
    @if(!empty($produk->gambar))
        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" class="mt-2 max-h-32">
    @endif
    @error('gambar')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700">
    {{ $submit ?? 'Simpan' }}
</button>