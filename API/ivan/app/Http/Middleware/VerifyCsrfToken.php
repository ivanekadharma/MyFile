<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
         'insert_data', 'update_data', 'delete_data', 'get_data', 'pulsa', 'minus', 'wallet_minus', 'wallet_plus', 'DoLogin', 'login', 'get_user_details', 'register', 'wallet', 'pulsa_operators'
    ];
}
