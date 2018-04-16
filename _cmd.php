<?php
/**
 * _cmd.php
 * Project: ntopngLogger
 * User: Sean McElhare (TheCrimsonCoder)
 * Github: http://www.github.com/thecrimsoncoder
 * Date: 4/15/2018
 * Time: 11:03
 */

namespace ntopngLogger;

require_once("_settings.php");

class _cmd
{
    public static function launchNTOPNG()
    {
        pclose(popen("start /B ". _settings::CMD_STRING, "r"));
        return true;
    }
}