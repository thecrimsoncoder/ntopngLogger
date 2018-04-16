<?php
/**
 * _logger.php
 * Project: ntopngLogger
 * User: Sean McElhare (TheCrimsonCoder)
 * Github: http://www.github.com/thecrimsoncoder
 * Date: 4/15/2018
 * Time: 11:03
 */

namespace ntopngLogger;

require_once("_settings.php");
class _logger
{
    public static function writeLog($json)
    {
        $log_array = self::buildLogArray($json);
        print_r($log_array);
        /*
        if(_settings::LOGGER_ENABLE_FILE_OUTPUT == true && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == false)
        {
            if(self::writeLog($log_array))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        elseif(_settings::LOGGER_ENABLE_FILE_OUTPUT == false && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == true)
        {
            if(self::writeLogOutputDatabase($log_array))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        elseif(_settings::LOGGER_ENABLE_FILE_OUTPUT == true && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == true)
        {
            if(self::writeLogOutputFile($log_array) && self::writeLogOutputDatabase($log_array))
            {
                return true;
            }
            else{
                return false;
            }
        }
        else
        {
            return "!! _logger.php > NO LOGGING METHOD SPECIFIED!";
        }
        */
    }
    private static function writeLogOutputFile($log_array)
    {
    }
    private static function writeLogOutputDatabase($log_array)
    {
        require_once("_db.php");
    }
    private static function buildLogArray($json)
    {
        $json_array = json_decode($json,true);
        $datestamp = date('Y-m-d');
        $timestamp = date('h:i:s');

        $log_array = array(
            "Date" => $datestamp,
            "Time" => $timestamp,
            "IP_Address" => $json_array["ip"]["ip"],
            "IP_Version" => $json_array["ip"]["ipVersion"],
            "MAC_Address" => $json_array["mac_address"],
            "ISP" => $json_array["asname"],
            "TCP_BYTES_RECV" => $json_array["tcp_sent"]["bytes"],
            "TCP_BYTES_SENT" => $json_array["tcp_rcvd"]["bytes"]
        );
        return $log_array;
    }
}