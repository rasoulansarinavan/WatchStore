<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id')->withDefault(['title' => 'دسته اصلی']);
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');

    }

    public static function saveImage($file)
    {
        if ($file) {
            $name = time() . '.' . $file->extension();
            $smallImage = Image::make($file->getRealPath());
            $bingImage = Image::make($file->getRealPath());
            $smallImage->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('local')->put('admin/categories/small/' . $name, (string)$smallImage->encode('png', 90));
            Storage::disk('local')->put('admin/categories/big/' . $name, (string)$bingImage->encode('png', 90));
            return $name;
        } else {
            return '';
        }
    }

    public static function getAllCategories()
    {
        $categories = self::query()->get();
        return CategoryResource::collection($categories);
    }
}
