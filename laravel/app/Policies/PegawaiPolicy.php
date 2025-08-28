<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Auth\Access\HandlesAuthorization;

class PegawaiPolicy
{
    use HandlesAuthorization;

    /**
     * Tentukan apakah user bisa melihat daftar pegawai.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Tentukan apakah user bisa melihat detail pegawai.
     */
    public function view(User $user, Pegawai $pegawai)
    {
        return $user->role === 'admin' || $user->pegawai->id === $pegawai->id;
    }

    /**
     * Tentukan apakah user bisa membuat data untuk pegawai.
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Tentukan apakah user bisa mengupdate data pegawai.
     */
    public function update(User $user, Pegawai $pegawai)
    {
        return $user->role === 'admin' || $user->pegawai->id === $pegawai->id;
    }

    /**
     * Tentukan apakah user bisa menghapus pegawai.
     */
    public function delete(User $user, Pegawai $pegawai)
    {
        return $user->role === 'admin';
    }

    /**
     * Custom policy: Manage Face Encoding
     */
    public function manageFaceEncoding(User $user, Pegawai $pegawai)
    {
        return $user->role === 'admin' || $user->pegawai?->id === $pegawai->id;
    }
}
