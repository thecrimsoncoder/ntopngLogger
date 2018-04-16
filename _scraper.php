<?php
/**
 * _scraper.php
 * Project: ntopngLogger
 * User: Sean McElhare (TheCrimsonCoder)
 * Github: http://www.github.com/thecrimsoncoder
 * Date: 4/15/2018
 * Time: 19:09
 */

namespace ntopngLogger;

require_once ("_settings.php");
class _scraper
{
    public static function scrapeJSON()
    {
        $curl = curl_init();

        curl_setopt_array($curl,
                            array(
                                    CURLOPT_PORT => _settings::SCRAPER_CURL_PORT,
                                    CURLOPT_URL => _settings::SCRAPER_CURL_URL,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 30,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_HTTPHEADER => array(
                                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                                        "Accept-Encoding: gzip, deflate, br",
                                        "Accept-Language: en-US,en;q=0.9",
                                        "Cache-Control: no-cache",
                                        "Connection: keep-alive",
                                        "Cookie: user=nologin; session=",
                                        "DNT: 1",
                                        _settings::SCRAPER_CURL_REFERER,
                                        "Upgrade-Insecure-Requests: 1",
                                        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36"
                                    ),
                            ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        }
        else {
            return $response;
        }
    }
}