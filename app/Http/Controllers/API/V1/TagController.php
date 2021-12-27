<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TagController extends Controller
{
//    protected $tags = '';
//
//    public function __construct(Campaign $campaign)
//    {
//        $this->tags = $campaign;
//    }

    public function list(Request $request)
    {
        $page = $request->query('page');
        $perPage = $request->query('per_page');

        if (empty($perPage)) {
            $perPage = Config::get('constants.per_page');
        }
        $offset = ($page - 1) * $perPage;
        $tag = Campaign::query()->join("stats as s", "c.id", '=', 's.zid')
            ->select('c.*', 's.total_impress', 's.ads_rev')
            ->where('c.status', '=', 1)
            ->limit($perPage)->offset($offset)
            ->toSql();
        dd($tag);

        $countTag = Campaign::query()->join("stats as s", "c.id", '=', 's.zid')
            ->select('c.*', 's.total_impress', 's.ads_rev')->count();

        $response = [
            'success' => true,
            'data' => $tag,
            'count' => $countTag,
            'message' => 'Product list',
        ];

        return response()->json($response, 200);
    }
}
