<?php

namespace App\Enums\ViewPaths\Admin;

enum videomsg
{
    const LIST = [
        URI => 'view',
        VIEW => 'admin-views.videomessage.view'
    ];

    const STORE = [
        URI => 'store',
        VIEW => ''
    ];

    const UPDATE = [
        URI => 'update',
        VIEW => 'admin-views.videomessage.edit'
    ];

    const DELETE = [
        URI => 'delete',
        VIEW => ''
    ];
}