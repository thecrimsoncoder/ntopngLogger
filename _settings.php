<?php
class _settings
{
    /********************************************************************************************************/
    /** AUTHENTICATION CONSTANTS */
    /** ntopng Login URL Path */
    const AUTH_URL = "http://localhost:3000/lua/login.lua?";

    /** Default Login Credentials for ntopng */
    /**
    const AUTH_USERNAME = "admin";
    const AUTH_PASSWORD = "admin";
    */

    const AUTH_USERNAME = "ntopnglogger";
    const AUTH_PASSWORD = "ntopnglogger!";

    /** Login Form Elements */
    const AUTH_USERNAME_INPUT = "_username";
    const AUTH_PASSWORD_INPUT = "password";
    const AUTH_CLIENT_REFERER = "referer=localhost:3000";
    const AUTH_LOGIN_STRING = self::AUTH_CLIENT_REFERER."&".self::AUTH_USERNAME_INPUT."=".self::AUTH_USERNAME."&".self::AUTH_PASSWORD_INPUT."=".self::AUTH_PASSWORD."/";

    const AUTH_SESSION_STORE = "./session_store/";
    const AUTH_SESSION_STORE_FILE = "session.txt";
    const AUTH_SESSION_STORE_STRING = self::AUTH_SESSION_STORE.self::AUTH_SESSION_STORE_FILE;

    /********************************************************************************************************/
    /** LOGGER CONSTANTS */
    const LOGGER_STREAM = "";

    /********************************************************************************************************/
    /** DB CONSTANTS */
    const DB_HOST = "localhost";
    const DB_DATABASE = "";
    const DB_USERNAME = "";
    const DB_PASSWORD = "";

    /********************************************************************************************************/
}