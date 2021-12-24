<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Campaign;

class TagController extends Controller
{
    protected $tags = '';

    public function __construct(Campaign $campaign)
    {
        $this->tags = $campaign;
    }

    public function list()
    {
        $tag = $this->tags->paginate(3);

        $response = [
            'success' => true,
            'data' => $tag,
            'message' => 'Product list',
        ];

        return response()->json($response, 200);
    }
}
