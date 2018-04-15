<?php
/**
 * Created by PhpStorm.
 * User: seanm
 * Date: 4/14/2018
 * Time: 21:21
 */

namespace ntopngLogger;

require_once "_settings.php";

class _authentication
{
    public static function login()
    {
        $post_login_string = \_settings::AUTH_USERNAME_INPUT."=".\_settings::AUTH_USERNAME."&".\_settings::AUTH_PASSWORD_INPUT."=".\_settings::AUTH_PASSWORD;
        echo("$post_login_string");
    }
}