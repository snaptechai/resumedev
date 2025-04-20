<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $packages->map(function($faq) {
            $faq->full_description = $this->ul_to_array($faq->full_description);
        });
    
        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'data' => $packages
        ], 200);
    }

    public function show(string $id)
    {
        $packages = DB::table('addons')->where('package_id', $id)->get();
        $packages->map(function($faq) {
            unset($faq->created_at);
            unset($faq->updated_at);
        });

        if($packages->count() > 0)
        {
            return response()->json([
                'http_status' => 200,
                'http_status_message' => 'Success',
                'data' => $packages
            ], 200);
        }
        else
        {
            return response()->json([
                'http_status' => 404,
                'http_status_message' => 'Not Found',
            ], 200);
        }
       
    }

    private function ul_to_array ($ul) {
        $str =  str_replace(array('<ul>', '</ul>', '<li>'), '', $ul);
        return explode('</li>', $str);
    }
}
