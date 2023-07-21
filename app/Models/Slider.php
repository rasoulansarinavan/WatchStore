<?php

namespace App\Models;

use App\Http\Resources\SliderResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'image',
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
            Storage::disk('local')->put('admin/sliders/small/' . $name, (string)$smallImage->encode('png', 90));
            Storage::disk('local')->put('admin/sliders/big/' . $name, (string)$bingImage->encode('png', 90));
            return $name;
        } else {
            return '';
        }
    }

    public static function getSliders()
    {
        $sliders = Slider::query()->get();
        return SliderResource::collection($sliders);
    }

}
