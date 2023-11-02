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

use libphonenumber\geocoding\PhoneNumberOfflineGeocoder;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;
use Maatify\Logger\Logger;

class PhoneNumberValidation
{
    private static ?PhoneNumberUtil $phoneUtil = null;
    protected static ?PhoneNumberValidation $instance = null;

    private static string $defaultRegion = 'EG';
    private static string $mobileNumber;

    public function __construct(/*string $mobileNumber*/)
    {
        if(null === self::$phoneUtil){
            self::$phoneUtil = PhoneNumberUtil::getInstance();
//            self::$mobileNumber = $mobileNumber;
        }
        return $this;
    }

    public static function getInstance(): PhoneNumberValidation
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    public function SetRegion(string $countryCode = ''): static
    {
        if(empty($countryCode)) $countryCode = (new geoPlugin())->CountryCode()?: self::$defaultRegion;
        self::$defaultRegion = $countryCode;
        return $this;
    }

    public function SetNumber(string $mobileNumber): static
    {
        self::$mobileNumber = $mobileNumber;
        return $this;
    }

    private static function NumberProto(): ?PhoneNumber
    {
        try {
            return self::$phoneUtil->parse(self::$mobileNumber, self::$defaultRegion);
        }catch (NumberParseException $numberParseException){
            Logger::RecordLog($numberParseException);
            return null;
        }

    }

    public function NumberCountry(): string
    {
        $swissNumberProto = self::NumberProto();
        $geocoder = PhoneNumberOfflineGeocoder::getInstance();
        return $geocoder->getDescriptionForNumber($swissNumberProto, "en_US");
    }

    public function NumberOperator(): string
    {
        $swissNumberProto = self::NumberProto();
        $carrierMapper = PhoneNumberToCarrierMapper::getInstance();
        return $carrierMapper->getNameForNumber($swissNumberProto, "en");
    }

    public function NumberRegionCode(): string
    {
        $swissNumberProto = self::NumberProto();
        return self::$phoneUtil->getRegionCodeForNumber($swissNumberProto);
    }

    public function NumberIsValid(): bool
    {
        try {
            $swissNumberProto = self::NumberProto();
            return self::$phoneUtil->isValidNumber($swissNumberProto);
        }catch (NumberParseException $numberParseException){
            Logger::RecordLog($numberParseException);
            return false;
        }
    }

    public function NumberFormat(string $mobileNumber): string
    {
        $swissNumberProto = self::NumberProto($mobileNumber);
//        return self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::E164);
//        return self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::NATIONAL);
//        return self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::INTERNATIONAL);
//        return self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::RFC3966);

        return self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::E164);
//            . '<br>' .
//        self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::NATIONAL) . '<br>' .
//            self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::INTERNATIONAL) . '<br>' .
//            self::$phoneUtil->format($swissNumberProto, PhoneNumberFormat::RFC3966);

    }

    public function NumberFormatE164(): string
    {
        return self::$phoneUtil->format(self::NumberProto(), PhoneNumberFormat::E164);
    }

    public function NumberFormatNational(): string
    {
        return self::$phoneUtil->format(self::NumberProto(), PhoneNumberFormat::NATIONAL);
    }

    public function NumberFormatInternational(): string
    {
        return self::$phoneUtil->format(self::NumberProto(), PhoneNumberFormat::INTERNATIONAL);
    }


    public function Validation(string $mobileNumber)
    {
//        $swissNumberStr = "97972811";
        $swissNumberStr = self::$mobileNumber;
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $swissNumberProto = $phoneUtil->parse($swissNumberStr, "KW");

//            $isValid = $phoneUtil->isValidNumber($swissNumberProto);
//            $phoneUtil->format($swissNumberProto, PhoneNumberFormat::E164);
//            $phoneUtil = PhoneNumberUtil::getInstance();
//            $geocoder = PhoneNumberOfflineGeocoder::getInstance();
//            $geocoder->getDescriptionForNumber($swissNumberProto, "en_US");
//            $phoneUtil = PhoneNumberUtil::getInstance();
//            $swissNumberProto = $phoneUtil->parse("+201095556063", "CH");
//            $carrierMapper = PhoneNumberToCarrierMapper::getInstance();
//            $carrierMapper->getNameForNumber($swissNumberProto, "en");
//            $geocoder->getDescriptionForNumber($swissNumberProto, "en_US");
//            $phoneUtil = PhoneNumberUtil::getInstance();
//            $carrierMapper->getSafeDisplayName($swissNumberProto, "en");
//            $swissNumberProto = $phoneUtil->parse("00201095556063", "CH");
//            $timeZoneMapper = \libphonenumber\PhoneNumberToTimeZonesMapper::getInstance();
//            $timeZones = $timeZoneMapper->getTimeZonesForNumber($swissNumberProto);
//            echo $phoneUtil->format($swissNumberProto, PhoneNumberFormat::E164) . '<br>';
//            echo $phoneUtil->format($swissNumberProto, PhoneNumberFormat::NATIONAL) . '<br>';
//            echo $phoneUtil->format($swissNumberProto, PhoneNumberFormat::INTERNATIONAL) . '<br>';
//            echo $phoneUtil->format($swissNumberProto, PhoneNumberFormat::RFC3966) . '<br>';
//            echo $phoneUtil->getRegionCodeForNumber($swissNumberProto); // GB
// returns array("Europe/Zurich")

        } catch (NumberParseException $e) {
            var_dump($e);
        }

    }
}