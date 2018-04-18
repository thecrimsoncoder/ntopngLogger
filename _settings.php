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

    const CMD_TARGET_STREAM_IP = "70.91.56.203";
    const CMD_CAPUTURE_INTERFACE = 2;
    const CMD_STRING = 'ntopng /c -i '.self::CMD_CAPUTURE_INTERFACE.' -B "src host '.self::CMD_TARGET_STREAM_IP.' or dst host '.self::CMD_TARGET_STREAM_IP.'" --disable-login 0 --community';

    /********************************************************************************************************/
    /** LOGGER CONSTANTS */

    const LOGGER_ENABLE_FILE_OUTPUT = true;
    const LOGGER_ENABLE_DATABASE_OUTPUT = false;
    const LOGGER_EXPORT_FILE = "logfile.txt";

    /********************************************************************************************************/
    /** SCRAPER CONSTANTS */

    const SCRAPER_CURL_PORT = 3000;
    const SCRAPER_CURL_URL = "http://localhost:3000/lua/host_get_json.lua?ifid=0&host=".self::CMD_TARGET_STREAM_IP;
    const SCRAPER_CURL_REFERER = "Referer: http://localhost:3000/lua/host_details.lua?host=".self::CMD_TARGET_STREAM_IP;

    /********************************************************************************************************/
    /** DB CONSTANTS */

    const DB_HOST = "localhost";
    const DB_DATABASE = "";
    const DB_USERNAME = "";
    const DB_PASSWORD = "";

    /********************************************************************************************************/
}