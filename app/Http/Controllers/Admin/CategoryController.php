<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ecourse;

class CategoryController extends Controller
{
    /**
     * Delete a category if it is not used by any ecourse.
     */
    public function destroy(Request $request, $id)
    {
        // Find category
        $category = Category::where('id_category', $id)->first();
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan.'], 404);
        }

        // Check if any ecourse references this category
        $used = Ecourse::where('id_category', $id)->exists();
        if ($used) {
            return response()->json(['success' => false, 'message' => 'Kategori masih digunakan oleh setidaknya satu e-course. Hapus atau pindahkan e-course terlebih dahulu.'], 409);
        }

        try {
            $category->delete();
            return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus.']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus kategori.'], 500);
        }
    }
}
