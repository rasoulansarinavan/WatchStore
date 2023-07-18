<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliserRequest;
use App\Models\Brand;
use App\Models\Slider;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لبست برندها';
//        $brands = Brand::all();
        return view('admin.brand.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد برند';
        return view('admin.brand.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Brand::createBrand($request);
        return redirect()->route('brands.index')->with('message', 'برند با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::query()->find($id);
        $title = 'ویرایش برند';
        return view('admin.brand.edit', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image = Brand::saveImage($request->file);
        $brand = Brand::query()->find($id);
        $brands = Brand::query()->pluck('title', 'id');
        $brand->update([
            'title' => $request->input(['title']),
            'image' => $image
        ]);
        return redirect()->route('brands.index')->with('message', 'برند با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
