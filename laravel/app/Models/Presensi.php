<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';
    protected $guarded = ['id'];
    // protected $dates = ['deleted_at'];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function aturan()
    {
        return $this->belongsTo(Rule::class, 'aturan_presensi_id');
    }
}
