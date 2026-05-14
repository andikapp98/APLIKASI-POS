<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryServices;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * CategoryController
 *
 * Controller untuk menangani HTTP request terkait kategori produk.
 * Menggunakan service layer untuk business logic dan API resource untuk response formatting.
 */
class CategoryController extends Controller
{
    private $categoryServices;

    /**
     * Konstruktor untuk dependency injection
     *
     * @param CategoryServices $categoryServices - Instance service kategori
     */
    public function __construct(
        CategoryServices $categoryServices
    ){
        $this->categoryServices = $categoryServices;
    }

    /**
     * Mengambil semua kategori dengan pagination
     *
     * @return \Illuminate\Http\JsonResponse - Response JSON dengan collection kategori
     */
    public function index()
    {
        $fields = ['id', 'name', 'description', 'photo'];
        $categories = $this->categoryServices->getAll($fields);

        return response()->json(CategoryResource::collection($categories));
    }

    /**
     * Mengambil detail kategori berdasarkan ID
     *
     * @param int $id - ID kategori yang ingin diambil
     * @return \Illuminate\Http\JsonResponse - Response JSON dengan detail kategori atau error 404
     */
    public function show($id)
    {
        try {
            $fields = ['id', 'name', 'description', 'photo'];
            $category = $this->categoryServices->getById($id, $fields);

            return response()->json(new CategoryResource($category));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Membuat kategori baru
     *
     * @param CategoryRequest $request - Request yang sudah divalidasi
     * @return \Illuminate\Http\JsonResponse - Response JSON dengan kategori yang baru dibuat (status 201)
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryServices->create($data);

        return response()->json(new CategoryResource($category), 201);
    }

    /**
     * Memperbarui kategori berdasarkan ID
     *
     * @param CategoryRequest $request - Request yang sudah divalidasi
     * @param int $id - ID kategori yang ingin diperbarui
     * @return \Illuminate\Http\JsonResponse - Response JSON dengan kategori yang telah diperbarui atau error 404
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $category = $this->categoryServices->update($id, $data);

            return response()->json(new CategoryResource($category));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }

    /**
     * Menghapus kategori berdasarkan ID
     *
     * @param int $id - ID kategori yang ingin dihapus
     * @return \Illuminate\Http\JsonResponse - Response JSON dengan pesan sukses atau error 404
     */
    public function destroy($id)
    {
        try {
            $this->categoryServices->delete($id);

            return response()->json(['message' => 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
