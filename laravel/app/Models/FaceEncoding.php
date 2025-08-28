<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaceEncoding extends Model
{
    use HasFactory;

    use HasFactory;
    use SoftDeletes;

    protected $table = 'face_encodings';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    protected $casts = [
        'encodings' => 'array'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
