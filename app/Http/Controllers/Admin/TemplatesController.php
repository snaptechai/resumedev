<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::paginate(10);
        $packages = Package::all();
        return view('admin.templates.index', compact('templates','packages'));
    } 

    public function store(Request $request)
    {
        try {
            $request->validate([ 
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = $request->file('image')->store('templates', 'public');

            Template::create([
                'package' => $request->package,
                'image' => $imagePath,
                'added_by' =>  Auth::id(),
                'added_date' => Carbon::now()->format('yy-mm-dd'),
            ]);

            return redirect()->back()->with('success', 'Template created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }
 
    public function update(Request $request, string $id)
    { 
        try { 
            $request->validate([ 
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $template = Template::findOrFail($id); 
    
            if ($request->hasFile('image')) { 
                if ($template->image && Storage::disk('public')->exists($template->image)) {
                    Storage::disk('public')->delete($template->image);
                } 
            }
            $imagePath = $request->file('image')->store('templates', 'public');
     
            $template->update([
                'package' => $request->package,
                'image' => $imagePath,
                'last_modified_by' =>  Auth::id(),
                'last_modified_date' => Carbon::now()->format('yy-mm-dd'),
            ]);
        
            return redirect()->back()->with('success', 'Template updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }
 
    public function destroy(Template $template)
    {
        if ($template->image) {
            Storage::disk('public')->delete($template->image);
        }

        $template->delete();

        return redirect()->back()->with('success', 'Template deleted successfully!');
    }
}