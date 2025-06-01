<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    public function getBanner()
    {
        $banner = Banner::where('banner_status', 'active')
            ->where('end_date', '>', now())
            ->first();

        if ($banner) {
            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'data' => [
                    'id' => $banner->id,
                    'description' => $banner->description,
                    'background_color' => $banner->background_color,
                    'font_color' => $banner->font_color,
                    'timmer_status' => $banner->timmer_status == 'active',
                    'number_of_dates' => $banner->number_of_dates,
                    'end_date' => $banner->end_date,
                ],
            ]);
        }

        return response()->json([
            'http_status' => 404,
            'http_status_message' => 'Not Found',
            'message' => 'No active banner found.',
        ], 404);
    }
}
