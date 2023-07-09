<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Color;
use App\Models\Brand;
use App\Models\Colors;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لبست رنگ ها';
        return view('admin.color.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد رنگ';
        return view('admin.color.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Colors::query()->create([
            'title' => $request->input(['title']),
            'code' => $request->input(['code'])
        ]);
        return redirect()->route('colors.index')->with('message', 'رنگ با موفقیت ایجاد شد');
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
        $color = Colors::query()->find($id);
        $title = 'ویرایش رنگ';
        return view('admin.color.edit', compact('title', 'color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color = Colors::query()->find($id);
        $brands = Colors::query()->pluck('title', 'id');
        $color->update([
            'title' => $request->input(['title']),
            'code' => $request->input(['code'])
        ]);
        return redirect()->route('colors.index')->with('message', 'رنگ با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
