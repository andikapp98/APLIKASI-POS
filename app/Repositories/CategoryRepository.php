<?php

namespace App\Repositories;

use App\Models\Category;;

/**
 * CategoryRepository
 * 
 * Kelas repository untuk menangani operasi CRUD pada model Category.
 * Menyediakan antarmuka untuk mengakses dan memanipulasi data kategori dari database.
 */
class CategoryRepository
{
    /**
     * Mengambil semua kategori dengan pagination
     * 
     * @param array $fields - Nama-nama kolom yang ingin diambil dari database
     * @return \Illuminate\Pagination\LengthAwarePaginator - Hasil query dengan pagination 10 item per halaman
     */
    public function getAll(array $fields)
    {
        return Category::select($fields)->latest()->paginate(10);
    }

    /**
     * Mengambil kategori berdasarkan ID
     * 
     * @param int $id - ID kategori yang ingin diambil
     * @param array $fields - Nama-nama kolom yang ingin diambil dari database
     * @return \App\Models\Category - Objek kategori yang ditemukan
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Jika kategori tidak ditemukan
     */
    public function getById(int $id, array $fields)
    {
        return Category::select($fields)->findOrFail($id);
    }

    /**
     * Membuat kategori baru
     * 
     * @param array $data - Array berisi data kategori yang akan disimpan (nama, deskripsi, dll)
     * @return \App\Models\Category - Objek kategori yang baru dibuat
     */
    public function create(array $data){
        return Category::create($data);
    }

    /**
     * Memperbarui kategori berdasarkan ID
     * 
     * @param int $id - ID kategori yang ingin diperbarui
     * @param array $data - Array berisi data kategori yang akan diperbarui
     * @return \App\Models\Category - Objek kategori yang telah diperbarui
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Jika kategori tidak ditemukan
     */
    public function update(int $id, array $data){
        $category = Category::findOrFail($id);
        $category->update($data);

        return $category;
    }

    /**
     * Menghapus kategori berdasarkan ID
     * 
     * @param int $id - ID kategori yang ingin dihapus
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Jika kategori tidak ditemukan
     */
    public function delete(int $id){
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
