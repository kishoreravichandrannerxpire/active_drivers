<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create()
    {
      $banner = new Banner(); // create empty model instance
      return view('admin.banners.create', compact('banner'));
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
            'alt_text'    => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $data['status'] = $request->status === 'active' ? 1 : 0;

        $data['created_by'] = auth()->id() ?? 1;

        Banner::create($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
            'alt_text'    => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

         $data['status'] = $request->status === 'active' ? 1 : 0;

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
    
    public function viewActive()
    {
    // Fetch only active banners
        $banners = Banner::where('status', 1)->get();

        return view('admin.banners.view', compact('banners'));
   }

}
