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
        $log_string = $log_array["Date"]."\t".
                      $log_array["Time"]."\t".
                      $log_array["IP_Address"]."\t".
                      $log_array["IP_Version"]."\t".
                      $log_array["MAC_Address"]."\t".
                      $log_array["ISP"]."\t".
                     (int)$log_array["TCP_BYTES_RECV"]."\t".
                     (int)$log_array["TCP_BYTES_SENT"]."\t".
                     (int)$log_array["CURRENT_BANDWIDTH_RECV"]."\t".
                     (int)$log_array["CURRENT_BANDWIDTH_SENT"].PHP_EOL;
        print($log_string);
        file_put_contents(_settings::LOGGER_EXPORT_FILE,$log_string,FILE_APPEND);
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
            "TCP_BYTES_RECV" => (int)$json_array["tcp_sent"]["bytes"]/1000,
            "TCP_BYTES_SENT" => (int)$json_array["tcp_rcvd"]["bytes"]/1000,
            "CURRENT_BANDWIDTH_RECV" => round((((int)$json_array["tcp_sent"]["bytes"] - (int)$last_update["CURRENT_BANDWIDTH_RECV"])/1000)/5),
            "CURRENT_BANDWIDTH_SENT" => round((((int)$json_array["tcp_rcvd"]["bytes"] - (int)$last_update["CURRENT_BANDWIDTH_SENT"])/1000)/5)
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
        /* Tokenize on Tab */
        $log_line_array = explode("\t",$line);
        $log_line_array_parsed =
            array(
            "Date" => $log_line_array[0],
            "Time" => $log_line_array[1],
            "IP_Address" => $log_line_array[2],
            "IP_Version" => $log_line_array[3],
            "MAC_Address" => $log_line_array[4],
            "ISP" => $log_line_array[5],
            "TCP_BYTES_RECV" => (int)$log_line_array[6],
            "TCP_BYTES_SENT" => (int)$log_line_array[7],
            "CURRENT_BANDWIDTH_RECV" => (int)$log_line_array[8],
            "CURRENT_BANDWIDTH_SENT" => (int)$log_line_array[9]
        );

        return $log_line_array_parsed;

    }
    private static function readLastUpdateFile()
    {
        if(!file_exists(_settings::LOGGER_EXPORT_FILE))
        {
            return
                array(
                "CURRENT_BANDWIDTH_RECV" => 0,
                "CURRENT_BANDWIDTH_SENT" => 0
                );
        }
        else
        {
            $file_line = file(_settings::LOGGER_EXPORT_FILE);
            $parsed_line = self::readLineToArray($file_line[count($file_line)-1]);
            return $parsed_line;
        }

    }
    private static function readLastUpdateDatabase()
    {
        $parsed_table = array();
        return $parsed_table;
    }
}