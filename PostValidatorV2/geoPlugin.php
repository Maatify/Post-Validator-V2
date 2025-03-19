<?php
/**
 * @copyright   ©2023 Maatify.dev
 * @Liberary    DB-Model
 * @Project     DB-Model
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2023-11-02 4:03 PM
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/Post-Validator-V2  view project on GitHub
 * @link        https://github.com/Maatify/Json (maatify/json)
 * @link        https://github.com/Maatify/Functions (maatify/functions)
 * @link        https://github.com/Maatify/Logger (maatify/logger)
 * @link        https://github.com/daveearley/Email-Validation-Tool (daveearley/daves-email-validation-tool)
 * @link        https://github.com/giggsey/libphonenumber-for-php (giggsey/libphonenumber-for-php)
 * @copyright   ©2023 Maatify.dev
 * @note        This Project using for MYSQL PDO (PDO_MYSQL).
 * @note        This Project extends other libraries maatify/logger, maatify/json, maatify/post-validator.
 *
 * @note        This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\PostValidatorV2;


class geoPlugin
{

    //the geoPlugin server
    private string $host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}&lang={LANG}';
    //	var $host = 'http://www.geoplugin.net/php.gp?ip={IP}';

    //the default base currency
    private string $currency = 'USD';

    //the default language
    private string $lang = 'en';
    /*
    supported languages:
    de
    en
    es
    fr
    ja
    pt-BR
    ru
    zh-CN
    */

    //initiate the geoPlugin vars
    public string $ip = '';
    public string $city = '';
    public string $region = '';
    public string $regionCode = '';
    public string $regionName = '';
    public string $dmaCode = '';
    public string $countryCode = '';
    public string $countryName = '';
    public int $inEU = 0;
    public bool $euVATrate = false;
    public string $continentCode = '';
    public string $continentName = '';
    public string $latitude = '';
    public string $longitude = '';
    public string $locationAccuracyRadius = '';
    public string $timezone = '';
    public string $currencyCode = '';
    public string $currencySymbol = '';
    public string $currencyConverter = '';

    public function __construct(string $ip = '')
    {
        return $this->Locate($ip);
    }

    public function CountryCode(string $ip = ''): string
    {
        return $this->countryCode;
    }

    public function CountryName(string $ip = ''): string
    {
        return $this->countryName;
    }

    private function RetrieveData(string $ip = ''): array
    {
        if (! empty($ip)) {
            $this->ip = $ip;
        }

        if (empty($this->ip)) {
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
        }

        $host = str_replace('{IP}', $this->ip, $this->host);
        $host = str_replace('{CURRENCY}', $this->currency, $host);
        $host = str_replace('{LANG}', $this->lang, $host);
        $response = $this->fetch($host);
        if ($response) {
            return unserialize($response);
        }

        return [];
    }

    public function Locate(string $ip = ''): static
    {
        $data = $this->RetrieveData($ip);
        $this->city = $data['geoplugin_city'] ?? '';
        $this->region = $data['geoplugin_region'] ?? '';
        $this->regionCode = $data['geoplugin_regionCode'] ?? '';
        $this->regionName = $data['geoplugin_regionName'] ?? '';
        $this->dmaCode = $data['geoplugin_dmaCode'] ?? '';
        $this->countryCode = $data['geoplugin_countryCode'] ?? '';
        $this->countryName = $data['geoplugin_countryName'] ?? '';
        $this->inEU = $data['geoplugin_inEU'] ?? 0;
        $this->euVATrate = $data['geoplugin_euVATrate'] ?? false;
        $this->continentCode = $data['geoplugin_continentCode'] ?? '';
        $this->continentName = $data['geoplugin_continentName'] ?? '';
        $this->latitude = $data['geoplugin_latitude'] ?? '';
        $this->longitude = $data['geoplugin_longitude'] ?? '';
        $this->locationAccuracyRadius
            = $data['geoplugin_locationAccuracyRadius'] ?? '';
        $this->timezone = $data['geoplugin_timezone'] ?? '';
        $this->currencyCode = $data['geoplugin_currencyCode'] ?? '';
        $this->currencySymbol = $data['geoplugin_currencySymbol'] ?? '';
        $this->currencyConverter = $data['geoplugin_currencyConverter'] ?? '';

        return $this;
    }

    /*    public function locate($ip = null): static
        {
            if (is_null($ip)) {
    //			$ip = $_SERVER['REMOTE_ADDR'];
                $ip = '156.193.15.66';
            }

            $host = str_replace('{IP}', $ip, $this->host);
            $host = str_replace('{CURRENCY}', $this->currency, $host);
            $host = str_replace('{LANG}', $this->lang, $host);

            $data = array();

            $response = $this->fetch($host);

            $data = unserialize($response);

            //set the geoPlugin vars
            $this->ip                = $ip;
            $this->city              = $data['geoplugin_city'];
            $this->region            = $data['geoplugin_region'];
            $this->regionCode        = $data['geoplugin_regionCode'];
            $this->regionName        = $data['geoplugin_regionName'];
            $this->dmaCode           = $data['geoplugin_dmaCode'];
            $this->countryCode       = $data['geoplugin_countryCode'];
            $this->countryName       = $data['geoplugin_countryName'];
            $this->inEU              = $data['geoplugin_inEU'];
            $this->euVATrate         = $data['geoplugin_euVATrate'];
            $this->continentCode     = $data['geoplugin_continentCode'];
            $this->continentName     = $data['geoplugin_continentName'];
            $this->latitude          = $data['geoplugin_latitude'];
            $this->longitude         = $data['geoplugin_longitude'];
            $this->locationAccuracyRadius
                                     = $data['geoplugin_locationAccuracyRadius'];
            $this->timezone          = $data['geoplugin_timezone'];
            $this->currencyCode      = $data['geoplugin_currencyCode'];
            $this->currencySymbol    = $data['geoplugin_currencySymbol'];
            $this->currencyConverter = $data['geoplugin_currencyConverter'];

            return $this;
        }*/

    public function fetch($host)
    {
        if (function_exists('curl_init')) {
            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
            $response = curl_exec($ch);
            curl_close($ch);
        } elseif (ini_get('allow_url_fopen')) {
            //fall back to fopen()
            $response = file_get_contents($host, 'r');
        } else {
            trigger_error(
                'geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ',
                E_USER_ERROR
            );
        }

        return $response;
    }

    public function convert($amount, $float = 2, $symbol = true)
    {
        //easily convert amounts to geolocated currency.
        if (! is_numeric($this->currencyConverter)
            || $this->currencyConverter == 0) {
            trigger_error(
                'geoPlugin class Notice: currencyConverter has no value.',
                E_USER_NOTICE
            );

            return $amount;
        }
        if (! is_numeric($amount)) {
            trigger_error(
                'geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.',
                E_USER_WARNING
            );

            return $amount;
        }
        if ($symbol === true) {
            return $this->currencySymbol . round(
                    ($amount * $this->currencyConverter),
                    $float
                );
        } else {
            return round(($amount * $this->currencyConverter), $float);
        }
    }

    public function nearby($radius = 10, $limit = null)
    {
        if (! is_numeric($this->latitude) || ! is_numeric($this->longitude)) {
            trigger_error(
                'geoPlugin class Warning: Incorrect latitude or longitude values.',
                E_USER_NOTICE
            );

            return array(array());
        }

        $host = "http://www.geoplugin.net/extras/nearby.gp?lat="
                . $this->latitude . "&long=" . $this->longitude
                . "&radius={$radius}";

        if (is_numeric($limit)) {
            $host .= "&limit={$limit}";
        }

        return unserialize($this->fetch($host));
    }


}