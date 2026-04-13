<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // Mengambil semua data barang beserta nama kategorinya dari database
        $items = Item::with('category')->latest()->get();
        
        // Mengirim data barang ke halaman view
        return view('admin.items.index', compact('items'));
    }
    // Fungsi untuk menampilkan halaman form tambah barang
    public function create()
    {
        // Ambil semua data kategori untuk ditampilkan di pilihan (dropdown)
        $categories = \App\Models\Category::all();
        
        return view('admin.items.create', compact('categories'));
    }

    // Fungsi untuk menyimpan data ke database
    public function store(Request $request)
    {
        // 1. Cek apakah data yang diinput user sudah benar dan tidak kosong
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'description' => 'nullable|string' // Boleh kosong
        ]);

        // 2. Simpan ke tabel items
        \App\Models\Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        // 3. Kembalikan ke halaman daftar barang
        return redirect()->route('items.index');
    }
    // Menampilkan form edit dengan data barang yang dipilih
    public function edit($id)
    {
        $item = \App\Models\Item::findOrFail($id);
        $categories = \App\Models\Category::all();
        
        return view('admin.items.edit', compact('item', 'categories'));
    }

    // Menyimpan perubahan data ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'description' => 'nullable|string'
        ]);

        $item = \App\Models\Item::findOrFail($id);
        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('items.index');
    }

    // Menghapus data barang
    public function destroy($id)
    {
        $item = \App\Models\Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index');
    }
}