<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Template;

class TemplateController extends Controller
{
    public function index()
    {
        $sliders = Template::where('is_active', 1)->get();

        $sliders->map(function ($slide) {
            $slide->image = asset('storage/'.$slide->image);
            unset($slide->package);
            unset($slide->added_by);
            unset($slide->added_date);
            unset($slide->last_modified_by);
            unset($slide->last_modified_date);
        });

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $sliders,
        ], 200);
    }
}
