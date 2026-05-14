<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\Storage;

/**
 * CategoryServices
 * 
 * Kelas service untuk menangani logika bisnis terkait kategori.
 * Bertindak sebagai lapisan antara controller dan repository, menangani
 * operasi CRUD kategori serta manajemen file foto kategori.
 */
class CategoryServices {
    private $categoryRepository;

    /**
     * Konstruktor untuk dependency injection
     * 
     * @param CategoryRepository $categoryRepository - Instance repository kategori
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ){
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Mengambil semua kategori dengan pagination
     * 
     * @param array $fields - Nama-nama kolom yang ingin diambil dari database
     * @return \Illuminate\Pagination\LengthAwarePaginator - Hasil query dengan pagination
     */
    public function getAll(array $fields)
    {
        return $this->categoryRepository->getAll($fields);
    }

    /**
     * Mengambil kategori berdasarkan ID
     * 
     * @param int $id - ID kategori yang ingin diambil
     * @param array $fields - Nama-nama kolom yang ingin diambil dari database (default: semua kolom)
     * @return \App\Models\Category - Objek kategori yang ditemukan
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Jika kategori tidak ditemukan
     */
    public function getById(int $id, array $fields)
    {
        return $this->categoryRepository->getById($id, $fields ?? ['*']);
    }

    /**
     * Membuat kategori baru dengan penanganan file foto
     * 
     * @param array $data - Array berisi data kategori (nama, deskripsi, photo)
     * @return \App\Models\Category - Objek kategori yang baru dibuat
     */
    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->categoryRepository->create($data);
    }

    /**
     * Memperbarui kategori dengan penanganan file foto
     * 
     * @param int $id - ID kategori yang ingin diperbarui
     * @param array $data - Array berisi data kategori yang akan diperbarui
     * @return \App\Models\Category - Objek kategori yang telah diperbarui
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Jika kategori tidak ditemukan
     */
    public function update(int $id, array $data)
    {
        $fields = ['id', 'photo'];
        $category = $this->categoryRepository->getById($id, $fields);
        if (isset($data['photo']) && $data['photo'] instanceof UploadFile) {
            // Hapus foto lama jika ada
            if (!empty($category->photo)) {
                $this->deletePhoto($category->photo);
            }
            // Upload foto baru
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->categoryRepository->update($id, $data);
    }

    /**
     * Menghapus kategori dan file foto terkait
     * 
     * @param int $id - ID kategori yang ingin dihapus
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException - Jika kategori tidak ditemukan
     */
    public function delete(int $id){
        $fields = ['id', 'photo'];
        $category = $this->categoryRepository->getById($id, $fields);
        if ($category->photo) {
            $this->deletePhoto($category->photo);
        }

        $this->categoryRepository->delete($id);
    }

    /**
     * Mengupload file foto kategori ke storage
     * 
     * @param UploadFile $photo - File foto yang akan diupload
     * @return string - Path relatif file yang telah diupload
     */
    private function uploadPhoto(UploadFile $photo)
    {
        return $photo->store('categories', 'public');
    }

    /**
     * Menghapus file foto kategori dari storage
     * 
     * @param string $photoPath - Path relatif file foto yang akan dihapus
     */
    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'categories/' . basename($photoPath);
        if (Storage::disk('public')->exist($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}