<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\UserApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    // Create Category
    public function categoryCreate(CategoryRequest $request)
    {
        try {
            $blog = Category::create([
                'slug' => $request->categoryName,
                'name' => $request->categoryName,
                'is_active' => $request->categoryIsActive,
            ]);
            return response()->json(UserApiResponse::success('Blog created successfully'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
    // List Category
    public function categoryList(Request $request)
    {
        try {
            $categories = Category::all();
            $categorieslist = CategoryResource::collection($categories);
            return response()->json(UserApiResponse::success($categorieslist, 'List of Categories'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
    // Category Details
    public function categorydetails(Request $request, $id)
    {
        try {
            $category = Category::where('id', $id)->get();
            $categoryDetail = CategoryResource::collection($category)->map->forCategoryDetail();
            return response()->json(UserApiResponse::success($categoryDetail, 'Category Details'), 200);
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
    // Update Category
    public function categoryUpdate(CategoryRequest $request, $id)
    {
        try {
            $blog = Category::find($id);
            if ($blog) {
                $blog->update([
                    'slug' => $request->categoryName,
                    'name' => $request->categoryName,
                    'is_active' => $request->categoryIsActive,
                ]);
                return response()->json(UserApiResponse::success('Category updated successfully'), 200);
            } else {
                return response()->json(UserApiResponse::error('Category not found'), 404);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
    // Delete Category
    public function categoryDelete(Request $request,$id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                return response()->json(UserApiResponse::success('Category deleted successfully'), 200);
            } else {
                return response()->json(UserApiResponse::error('Category not found'), 404);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
}
