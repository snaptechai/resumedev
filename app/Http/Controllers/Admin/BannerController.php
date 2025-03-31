<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
            $banners = Banner::paginate(10);
            return view('admin.banner.index', compact('banners')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function updateBannerStatus(Request $request, $bannerId)
    {
        $banner = Banner::findOrFail($bannerId); 
        $banner->banner_status = $request->banner_status;
        $banner->save();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->timmer_status);
        $banner = Banner::findOrFail($id); 
        $endDate = Carbon::today()->addDays((int) $request->number_of_dates)->format('Y-m-d'); // Cast to int

        $banner->description = $request->description;
        $banner->background_color = $request->background_color;
        $banner->font_color = $request->font_color;
        // $banner->added_by = $request->banner_status;
        // $banner->added_date = $request->banner_status;
        // $banner->last_modified_by = $request->banner_status;
        // $banner->last_modified_date = $request->banner_status;
        $banner->timmer_status = $request->timmer_status;
        $banner->banner_status = $request->banner_status;
        $banner->number_of_dates = $request->number_of_dates;
        $banner->end_date = $endDate;
        $banner->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}