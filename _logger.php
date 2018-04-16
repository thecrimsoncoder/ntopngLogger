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
        $json_array = json_decode($json);

        $log_array = array();
        return $log_array;
    }

}