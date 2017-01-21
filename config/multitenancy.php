<?php

return [
    /*
     * Domain name (without protocol, leading "www" or ".")
     */
    'domain' => 'example.com',
    'tenant' => [
        /**
         * Tenant FK in DB tables
         */
        'key' => 'tenant_id',

        /*
         * Tentant entity
         */
        'class' => 'App\Tenant',
    ]
];