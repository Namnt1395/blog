<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Categories\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;


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

        $categories = Category::query()->select("id", "title", "description", "created_time", "updated_time")
            ->where('status', '=', 1)
            ->limit($perPage)->offset($offset)
            ->get();

        return $this->sendResponse($categories, "Category list");
    }

    public function store(Request $request) {
        Log::info($request->all());
        return response()->json(['success' => true, 'message' => 'Project created successfully !','response'=>'']);

//        $response = Category::Create($request->all());
//
//        if ($response)
//            return response()->json(['success' => true, 'message' => 'Project created successfully !','response'=>$response]);
//        else
//            return response()->json(['success' => false, 'message' => 'Something went wrong.. Please try again later !']);
    }

    public function update(Request $request, $id)
    {
       // dd("request...", $request);
        try {
            $category = Category::findOrFail($id);
            $request->request->add(['updated_time' => now()->timestamp]);
            $category->update($request->all());
            return response()->json(['success' => true, 'message' => 'Project updated successfully !']);
        } catch(Exception $e) {
            Log::error("error:", $e);
            return response()->json(['success' => false, 'message' => 'Something went wrong.. Please try again later !']);
        }
    }

}
