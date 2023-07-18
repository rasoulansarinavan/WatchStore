<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class SmsCode extends Model
{
    use HasFactory;

    protected $fillable = ['mobile', 'code'];

    public static function checkTwoMinute($mobile)
    {
        $check = self::query()->where('mobile', $mobile)
            ->where('created_at', '>', Carbon::now()->subMinute(2))->first();
        if ($check) {
            return true;
        }
        return false;
    }

    public static function createSmsCode($mobile, $code)
    {
        self::query()->create(['mobile' => $mobile, 'code' => $code]);
    }
}
