<?php 

return [
    'debug' => env('APP_DEBUG', false),
    'process' => [
        [
            'id' => "20109551764e348a7a8c913045934777",
            'name' => 'درخواست مرخصی',
            'case' => [
                [ 
                    'id' => "45908983164e349077ed031067620029",
                    'name' => 'ثبت درخواست',  
                    'dynamic_view_form' => 'register',
                    'trigger' => 
                    [
                        [ 'name' => 'set user id', 'id' => '68379534364e3501fd57709063851566' ],
                        [ 'name' => 'set name of requester', 'id' => '98954906564e3553a082989062656447' ]
                    ]
                ],
                [ 
                    'id' => "88779770864e34907afc1d3022729094",
                    'name' => 'تایید درخواست',  
                    'dynamic_view_form' => 'register',
                    'trigger' => 
                    []
                ],
                [ 
                    'id' => "54062165665097091432573067587160",
                    'name' => 'تایید درخواست توسط رئیس',  
                    'dynamic_view_form' => 'register',
                    'trigger' => 
                    []
                ],
                [ 
                    'id' => "65732509464e35f99da1e28012350633",
                    'name' => 'انتقال تلفن',  
                    'dynamic_view_form' => 'register',
                    'trigger' => 
                    []
                ],
            ],
        ]
    ],
];