<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Categories\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class CategoryController extends BaseController
{

    public function list(Request $request)
    {
        $page = $request->query('page');

        $perPage = $request->query('per-page');
        if (empty($perPage)) {
            $perPage = Config::get('constants.per_page');
        }

        $offset = ($page - 1) * $perPage;

        $categories = Category::query()->select("id", "title", "description")
            ->where('status', '=', 1)
            ->limit($perPage)->offset($offset)
            ->get();

        return $this->sendResponse($categories, "Category list");
    }


    public function updateData(Request $request)
    {
       // dd("request...", $request);
        return response()->json(['success' => true, 'message' => 'Project updated successfully !']);
    }

}
