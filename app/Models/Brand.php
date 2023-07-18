<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image'
    ];

    public static function saveImage($file)
    {
        if ($file) {
            $name = time() . '.' . $file->extension();
            $smallImage = Image::make($file->getRealPath());
            $bingImage = Image::make($file->getRealPath());
            $smallImage->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('local')->put('admin/brands/small/' . $name, (string)$smallImage->encode('png', 90));
            Storage::disk('local')->put('admin/brands/big/' . $name, (string)$bingImage->encode('png', 90));
            return $name;
        } else {
            return '';
        }
    }

    public static function createBrand($request)
    {
        $image = self::saveImage($request->image);
        Brand::query()->create([
            'title' => $request->input('title'),
            'image' => $image
        ]);
    }
}
