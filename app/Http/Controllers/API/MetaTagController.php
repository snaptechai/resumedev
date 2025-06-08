<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use Illuminate\Http\Request;

class MetaTagController extends Controller
{
    public function getMeta(Request $request)
    {
        $url = $request->input('url');

        $specificMetaTags = null;
        
        if ($url) {
            $specificMetaTags = MetaTag::where('url', $url)->where('is_active', 1)->first();
        }

        $globalMetaTags = MetaTag::whereNull('url')->where('is_active', 1)->first();

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => [
                'global_meta_tags' => $globalMetaTags,
                'specific_meta_tags' => $specificMetaTags,
            ],
        ], 200);
    }
}
