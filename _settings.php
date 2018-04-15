<?php
/**
 * _settings.php
 * Project: ntopngLogger
 * User: Sean McElhare (TheCrimsonCoder)
 * Github: http://www.github.com/thecrimsoncoder
 * Date: 4/15/2018
 * Time: 11:03
 */
namespace ntopngLogger;
class _settings
{
    /********************************************************************************************************/
    /** CMD CONSTANTS */

    const CMD_TARGET_STREAM_IP = "108.50.203.80";
    const CMD_CAPUTURE_INTERFACE = 2;
    const CMD_STRING = 'ntopng /c -i '.self::CMD_CAPUTURE_INTERFACE.' -B "src host '.self::CMD_TARGET_STREAM_IP.' or dst host '.self::CMD_TARGET_STREAM_IP.'" --disable-login 0 --community';

    /********************************************************************************************************/
    /** LOGGER CONSTANTS */

    const LOGGER_ENABLE_FILE_OUTPUT = false;
    const LOGGER_ENABLE_DATABASE_OUTPUT = false;

    /********************************************************************************************************/
    /** DB CONSTANTS */

    const DB_HOST = "localhost";
    const DB_DATABASE = "";
    const DB_USERNAME = "";
    const DB_PASSWORD = "";

    /********************************************************************************************************/
}