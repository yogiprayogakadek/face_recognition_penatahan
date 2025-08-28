<?php

function dashboardRoute(): string
{
    $role = auth()->user()?->role;

    return $role === 'admin' ? 'dashboard.admin' : 'dashboard.pegawai';
}

function presensiRoute()
{
    $role = auth()->user()?->role;

    return $role === 'admin' ? 'presensi.index' : 'presensi.pegawai.index';
}

function jabatan()
{
    $jabatan = [
        'Perbekel',
        'Sekdes',
        'Kaur Perencanaan',
        'Kaur Keuangan',
        'Kasi Kesra',
        'Kaur Pemerintahan',
        'Kaur Umum',
        'Kasi Pelayanan',
        'Stap Operator',
        'Petugas Kebersihan',
        'Kawil Tegayang',
        'Kawil Penatahan Kelod',
        'Kawil Mongan',
        'Kawil Bedugul',
        'Kawil Kekeran',
        'Kawil Penatahan Kaja',
    ];

    return $jabatan;
}
