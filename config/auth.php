<?php
return [
'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
],

'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
    'admin_api' => [
        'driver'   => 'jwt',
        'provider' => 'users',
    ],
    'student_api' => [
        'driver'   => 'jwt',
        'provider' => 'students',
    ],
],
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ],
        'students' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Student::class
        ]
    ]
    ];

