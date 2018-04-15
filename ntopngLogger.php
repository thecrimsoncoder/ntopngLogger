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

_cmd::executeCommand(_settings::CMD_STRING);



