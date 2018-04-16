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
require_once("_cmd.php");
require_once ("_scraper.php");
require_once ("_logger.php");

if(_cmd::launchNTOPNG()) {
    while(true) {
        //_logger::writeLog(_scraper::scrapeJSON());
        file_put_contents("/logs/log.txt", _scraper::scrapeJSON() . "\n-----------------------------------------------------------------------------------------" . PHP_EOL, FILE_APPEND);
        sleep(5);
    }
}



