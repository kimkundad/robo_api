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
        'add_my_biller_id',
        'add_my_biller_file',
        'get_document_page/*',
        'get_document',
        'add_new_address',
        'change_status_biller_by_id',
        'add_new_biller',
        'add_new_device',
        'get_device',
        'get_device_by_id',
        'change_status_device_by_id',
        'admin/get_file_version',
        'get_qr_type',
        'add_new_api_service',
        'get_my_qr_type',
        'edit_api_service',
        'edit_api_service_callback_url',
        'get_tex_address_by_id',
        'edit_my_address',
        'del_my_address',
        'add_my_biller_file2'
    ];
}
