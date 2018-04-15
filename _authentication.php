<?php

namespace ntopngLogger;

require_once "_settings.php";

class _authentication
{
    public static function login()
    {
        $post_login_string = \_settings::AUTH_USERNAME_INPUT."=".\_settings::AUTH_USERNAME."&".\_settings::AUTH_PASSWORD_INPUT."=".\_settings::AUTH_PASSWORD;

        $curl_handler = curl_init();

            curl_setopt($curl_handler, CURLOPT_URL, \_settings::AUTH_URL);
            curl_setopt($curl_handler, CURLOPT_COOKIEJAR, \_settings::AUTH_SESSION_STORE_STRING);
            curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handler, CURLOPT_POST, 1);
            curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $post_login_string);

            $curl_exec = curl_exec($curl_handler);

            if(!$curl_exec)
            {
                return "!! ACTION: ".\_settings::AUTH_URL." was UNSUCCESSFUL!";
            }
            else
            {
                return $curl_exec;
            }
    }
}