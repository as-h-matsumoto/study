<?php
return array(
    /**
     * Sandbox und Live credentials
     */
    'credentials' => array(
        'sandbox' => array(
            'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
            'secret' => env('PAYPAL_SANDBOX_SECRET', '')
        ),
        'live' => array(
            'client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''),
            'secret' => env('PAYPAL_LIVE_SECRET', '')
        ),
    ),
    /**
     * SDK Konfiguration
     */
    'settings' => array(
        /**
         * Payment Mode
         *
         * Optionen: 'sandbox' oder 'live'
         */
        'mode' => env('PAYPAL_MODE', 'sandbox'),

        // Angabe in Sekunden
        'http.ConnectionTimeOut' => 3000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Log Level
         *
         * Optionen: 'DEBUG', 'INFO', 'WARN' oder 'ERROR'
         */
        'log.LogLevel' => 'DEBUG'
    ),
);