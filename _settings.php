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

    const CMD_TARGET_STREAM_IP = "83.211.71.120";
    const CMD_TARGET_STREAM_PORT = "8084";
    const CMD_CAPUTURE_INTERFACE = "";
    const CMD_STRING = "ntopng /c -h ";

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