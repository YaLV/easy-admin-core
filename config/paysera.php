<?php
return [
    'projectid'     => '138034',
    'sign_password' => 'b4c77e5ea1c199ea6a3e78f366287262',
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
        'accept' => 'payment.post.default',
//        'cancel' => 'payment.default'
        'cancel' => 'thankyou.default'
    ],

    /*
     * Used for get available payment methods
     * Here you can set what payment methods groupds should be return by default
     */
    'payment_groups' => ['e-banking', 'e-money', 'other'],


];