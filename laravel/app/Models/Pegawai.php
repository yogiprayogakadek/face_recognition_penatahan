<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pegawai';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    protected static function booted()
    {
        static::deleting(function ($pegawai) {
            if ($pegawai->user) {
                $pegawai->user->is_active = false;
                $pegawai->user->save();
            }
        });

        static::restoring(function ($pegawai) {
            if ($pegawai->user) {
                $pegawai->user->is_active = true;
                $pegawai->user->save();
            }
        });
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function faceEncoding()
    {
        return $this->hasOne(FaceEncoding::class, 'pegawai_id', 'id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'pegawai_id', 'id');
    }

    // Model Pegawai.php

    // Model Pegawai.php

    public function lastKehadiranMasuk()
    {
        return $this->hasOne(Kehadiran::class)
            ->where('tipe', 'masuk')
            ->latestOfMany('tanggal_absensi');
    }

    public function lastKehadiranPulang()
    {
        return $this->hasOne(Kehadiran::class)
            ->where('tipe', 'pulang')
            ->latestOfMany('tanggal_absensi');
    }
}
