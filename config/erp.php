<?php

return [
    'name' => env('ERP_NAME', 'Sembrando Vida ERP'),

    'version' => env('ERP_VERSION', '0.1.0'),

    'auto_discovery' => env('ERP_AUTO_DISCOVERY', true),

    'modules_path' => app_path('Modules'),

    'manifest' => 'module.json',
];