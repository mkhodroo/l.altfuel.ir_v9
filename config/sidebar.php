<?php

return [
    'menu' =>[
        
        'dashboard' => [
            'fa_name' => 'داشبرد',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'داشبرد', 'route-name' => '', 'route-url' => 'admin' ],
            ]
        ],
        'content' => [
            'fa_name' => 'محتوا',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'محتوا', 'route-name' => 'binshopsblog.admin.index', 'route-url' => '' ],
            ]
        ],
        'agencies' => [
            'fa_name' => 'مراکز',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'همه', 'route-name' => 'agency.list-form', 'route-url' => '' ],
            ]
        ],
        'users' => [
            'fa_name' => 'کاربران',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'همه', 'route-name' => '', 'route-url' => 'admin/user/all' ],
                'role' => [ 'fa_name' => 'نقش ها', 'route-name' => 'role.listForm', 'route-url' => '' ],
            ]
        ],
        'reports' => [
            'fa_name' => 'گزارش',
            'submenu' => [
                'issues' => [ 'fa_name' => 'تیکت', 'route-name' => '', 'route-url' => 'admin/report/ticket' ],
                'call' => [ 'fa_name' => 'تماس', 'route-name' => '', 'route-url' => 'admin/report/call' ],
                'guild' => [ 'fa_name' => 'پروانه کسب', 'route-name' => '', 'route-url' => 'admin/report/license' ],
                'irngv' => [ 'fa_name' => 'نظرسنجی irngv', 'route-name' => 'report.irngv.poll', 'route-url' => '' ],
            ]
        ],
        'asign-ins' => [
            'fa_name' => 'تخصیص بازرس',
            'submenu' => [
                'new' => [ 'fa_name' => 'درخواست جدید', 'route-name' => '', 'route-url' => 'admin/ins/asign/ins/form' ],
                'list' => [ 'fa_name' => 'لیست درخواست ها', 'route-name' => '', 'route-url' => 'admin/ins/show/all' ],
            ]
        ],
        'ins-requests' => [
            'fa_name' => 'لیست درخواست ها',
            'submenu' => [
                'list' => [ 'fa_name' => 'همه', 'route-name' => '', 'route-url' => 'admin/request/asign/ins/show/all' ],
            ]
        ],
        'irngv-poll' => [
            'fa_name' => 'اطلاعات دریافتی از irngv',
            'submenu' => [
                'irngv' => [ 'fa_name' => 'اطلاعات دریافتی', 'route-name' => 'admin.irngv.show.list', 'route-url' => '' ],
                'poll' => [ 'fa_name' => 'اطلاعات نظرسنجی', 'route-name' => 'admin.irngv.show.answers', 'route-url' => '' ],
            ]
        ],
        'tickets' => [
            'fa_name' => 'تیکت پشتیبانی',
            'submenu' => [
                'create' => [ 'fa_name' => 'ایجاد', 'route-name' => 'ATRoutes.index', 'route-url' => '' ],
                'show' => [ 'fa_name' => 'مشاهده', 'route-name' => 'ATRoutes.show.listForm', 'route-url' => '' ],
            ]
        ],

    ]
];