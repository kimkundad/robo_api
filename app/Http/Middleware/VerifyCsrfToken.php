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
        //
        'get_login',
        'get_register',
        'update_profile',
        'send_mail_to_contact',
        'check_name_user',
        'reset_password',
        'update_profile_avatar',
        'password/email',
        'password/myreset',
        'check_username',
        'check_logout',
        'add_my_biller_id'
    ];
}
