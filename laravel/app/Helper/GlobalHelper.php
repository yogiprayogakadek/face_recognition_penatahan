<?php

function dashboardRoute(): string
{
    $role = auth()->user()?->role;

    return $role === 'admin' ? 'dashboard.admin' : 'dashboard.pegawai';
}

function kehadiranRoute()
{
    $role = auth()->user()?->role;

    return $role === 'admin' ? 'kehadiran.index' : 'kehadiran.pegawai.index';
}

function jabatan()
{
    $jabatan = [
        'perbekel',
        'sekdes',
        'kaur perencanaan',
        'kaur keuangan',
        'kasi kesra',
        'kaur pemerintahan',
        'kaur umum',
        'kasi pelayanan',
        'stap operator',
        'petugas kebersihan',
        'kawil tegayang',
        'kawil penatahan kelod',
        'kawil mongan',
        'kawil bedugul',
        'kawil kekeran',
        'kawil penatahan kaja',
    ];

    return $jabatan;
}
