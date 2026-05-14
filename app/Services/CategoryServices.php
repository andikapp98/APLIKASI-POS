<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\Storage;

class CategoryServices {
    private $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ){
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll(array $fields)
    {
        return $this->categoryRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->categoryRepository->getById($id, $fields ?? ['*']);
    }

    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->categoryRepository->create($data);
    }

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

    public function delete(int $id){
        $fields = ['id', 'photo'];
        $category = $this->categoryRepository->getById($id, $fields);
        if ($category->photo) {
            $this->deletePhoto($category->photo);
        }

        $this->categoryRepository->delete($id);
    }

    private function uploadPhoto(UploadFile $photo)
    {
        return $photo->store('categories', 'public');
    }

    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'categories/' . basename($photoPath);
        if (Storage::disk('public')->exist($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}