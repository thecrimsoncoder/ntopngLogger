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

        if(_settings::LOGGER_ENABLE_FILE_OUTPUT == true && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == false)
        {
            if(self::writeLogOutputFile($log_array))
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
            die("!! _logger.php > NO LOGGING METHOD SPECIFIED!");
        }
    }
    private static function writeLogOutputFile($log_array)
    {
        /** CHANGE RETURN VALUE AFTER FUNCTION CONSTRUCTION */
        $log_string = $log_array["Date"]." ".
                      $log_array["Time"]." ".
                      $log_array["IP_Address"]." ".
                      $log_array["IP_Version"]." ".
                      $log_array["MAC_Address"]." ".
                      $log_array["ISP"]." ".
                      $log_array["TCP_BYTES_RECV"]." ".
                      $log_array["TCP_BYTES_SENT"].PHP_EOL,FILE_APPEND;
        return true;
    }
    private static function writeLogOutputDatabase($log_array)
    {
        require_once("_db.php");
        /** CHANGE RETURN VALUE AFTER FUNCTION CONSTRUCTION */
        return true;
    }
    private static function buildLogArray($json)
    {
        $json_array = json_decode($json,true);
        $datestamp = date('Y-m-d');
        $timestamp = date('h:i:s');
        $last_update = self::readLastUpdate();

        $log_array = array(
            "Date" => $datestamp,
            "Time" => $timestamp,
            "IP_Address" => $json_array["ip"]["ip"],
            "IP_Version" => $json_array["ip"]["ipVersion"],
            "MAC_Address" => $json_array["mac_address"],
            "ISP" => $json_array["asname"],
            "TCP_BYTES_RECV" => $json_array["tcp_sent"]["bytes"],
            "TCP_BYTES_SENT" => $json_array["tcp_rcvd"]["bytes"],
            "CURRENT_BANDWIDTH_RECV" => ($json_array["tcp_sent"]-$last_update["CURRENT_BANDWIDTH_RECV"])/5,
            "CURRENT_BANDWIDTH_SENT" => ($json_array["tcp_rcvd"]-$last_update["CURRENT_BANDWIDTH_SENT"])/5,
        );
        return $log_array;
    }
    private static function readLastUpdate()
    {
        if(_settings::LOGGER_ENABLE_FILE_OUTPUT == true && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == false)
        {
            return self::readLastUpdateFile();
        }
        elseif(_settings::LOGGER_ENABLE_FILE_OUTPUT == false && _settings::LOGGER_ENABLE_DATABASE_OUTPUT == true)
        {
            return self::readLastUpdateDatabase();
        }
        else
        {
            return self::readLastUpdateFile();
        }
    }
    private static function readLineToArray($line)
    {
        $log_line_array = explode(" ",$line);
        return
            array(
            "Date" => $log_line_array[0],
            "Time" => $log_line_array[1],
            "IP_Address" => $log_line_array[2],
            "IP_Version" => $log_line_array[3],
            "MAC_Address" => $log_line_array[4],
            "ISP" => $log_line_array[5],
            "TCP_BYTES_RECV" => $log_line_array[6],
            "TCP_BYTES_SENT" => $log_line_array[7],
            "CURRENT_BANDWIDTH_RECV" => $log_line_array[8],
            "CURRENT_BANDWIDTH_SENT" => $log_line_array[9],
        );
    }
    private static function readLastUpdateFile()
    {
        $file_line = file(_settings::LOGGER_EXPORT_FILE);

        if(!$file_line)
        {
            return
                array(
                "Date" => "",
                "Time" => "",
                "IP_Address" => "",
                "IP_Version" => "",
                "MAC_Address" => "",
                "ISP" => "",
                "TCP_BYTES_RECV" => "",
                "TCP_BYTES_SENT" => "",
                "CURRENT_BANDWIDTH_RECV" => 0,
                "CURRENT_BANDWIDTH_SENT" => 0,
            );
        }
        else
        {
            $parsed_line = self::readLineToArray($file_line[count($file_line - 1)]);
            return $parsed_line;
        }

    }
    private static function readLastUpdateDatabase()
    {
        $parsed_table = array();
        return $parsed_table;
    }
}