<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exclude Admin From Analytics Tracking
    |--------------------------------------------------------------------------
    |
    | When set to true, purchase and other ecommerce events will not be pushed
    | to the dataLayer for logged-in Admins and Super Admins.
    | Set TRACKING_EXCLUDE_ADMIN=false in your .env file to enable tracking
    | during admin test sessions.
    |
    */
    'exclude_admin' => env('TRACKING_EXCLUDE_ADMIN', true),

];
