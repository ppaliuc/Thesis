<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/paytm-callback',
        '/razorpay-notify',
        '/flutter/notify',
        '/coingate/notify',
        '/user/deposit/paytm-callback',
        '/user/deposit/razorpay-notify',
        '/api/user/subscription/flutter/notify*',
        '/api/user/deposit/paytm-callback',
        '/api/user/deposit/razorpay-notify',
        '/blockio/notify',
        '/user/deposit/flutter/notify*',
        '/user/subscription/paytm-callback',
        '/user/subscription/razorpay-notify',
        '/user/subscription/flutter/notify*',
    ];
}
