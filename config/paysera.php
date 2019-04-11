<?php
return [
    'projectid'     => '0',
    'sign_password' => 'd41d8cd98f00b204e9800998ecf8427e',
    'currency'      => 'EUR',
    'country'       => 'LV',

    // Test mode (sand box) 0 - off or 1 - on
    'test'          => 1,

    /*
     * Order model namespace
     * Package can automatically set order model status
     * If null, nothing gone happen
     */
    'order_model_namespace' => \App\Order::class,

    /*
     * URI where Paysera will send callback
     */
    'callback_uri' => 'paysera/callback',

    /*
     * Callback, accept and cancel routes names
     * PayseraMiddleWare will take care parsing data and etc.
     */
    'routes_names' => [
		'callback' => 'paysera.validate.default',
        'accept' => 'payment.post',
        'cancel' => 'payment.default'
    ],

    /*
     * Used for get available payment methods
     * Here you can set what payment methods groupds should be return by default
     */
    'payment_groups' => ['e-banking', 'e-money', 'other'],


];