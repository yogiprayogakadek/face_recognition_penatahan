<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'aturan_kehadiran';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    // public static function activateRule($id)
    // {
    //     DB::transaction(function () use ($id) {
    //         Rule::query()->update(['is_active' => false]);
    //         Rule::findOrFail($id)->update(['is_active' => true]);
    //     });
    // }
}
