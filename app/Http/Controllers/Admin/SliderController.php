<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliserRequest;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لبست اسلایدرها';
        return view('admin.slider.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد اسلایدرها';
        return view('admin.slider.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliserRequest $request)
    {
        $image = Slider::saveImage($request->file);
        Slider::query()->create([
            'title' => $request->input(['title']),
            'url' => $request->input(['url']),
            'image' => $image
        ]);
        return redirect()->route('sliders.index')->with('message', 'اسلایدر با موفقیت ایجاد شد');
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
        $slider = Slider::query()->find($id);
        $title = 'ویرایش اسلایدرها';
        return view('admin.slider.edit', compact('title', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliserRequest $request, string $id)
    {
        $image = Slider::saveImage($request->file);
        $slider = Slider::query()->find($id);
        $sliders = Slider::query()->pluck('title', 'id');
        $slider->update([
            'title' => $request->input(['title']),
            'url' => $request->input(['url']),
            'image' => $image
        ]);
        return redirect()->route('sliders.index')->with('message', 'اسلایدر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
