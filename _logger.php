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
    public static function writeLog($output)
    {
        if(_settings::LOGGER_ENABLE_FILE_OUTPUT == true && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == false)
        {
            if(self::writeLog($output))
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
            if(self::writeLogOutputDatabase($output))
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
            if(self::writeLogOutputFile($output) && self::writeLogOutputDatabase($output))
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
    private static function writeLogOutputFile($output)
    {
    }
    private static function writeLogOutputDatabase($output)
    {
        require_once("_db.php");
    }

}