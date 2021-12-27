<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * success response method
     *
     * @param $result
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
}
