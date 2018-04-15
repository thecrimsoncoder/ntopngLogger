<?php
/**
 * _ntopngLogger.php
 * Project: ntopngLogger
 * User: Sean McElhare (TheCrimsonCoder)
 * Github: http://www.github.com/thecrimsoncoder
 * Date: 4/15/2018
 * Time: 11:03
 */

namespace ntopngLogger;
require_once("_settings.php");
require_once("_cmd.php");

if(_cmd::executeCommand(_settings::CMD_STRING)) {
    while(true) {
        echo("loop");
        print_r(file_get_contents("http://localhost:3000/lua/host_get_json.lua?ifid=0&host=108.50.203.80"));
        sleep(10);
    }
}



