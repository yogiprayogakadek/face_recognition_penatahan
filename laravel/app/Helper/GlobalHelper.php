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
