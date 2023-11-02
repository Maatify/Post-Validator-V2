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

namespace Maatify\PostValidator;

class ValidatorConstants
{
    private static ValidatorConstants $instance;

    public static function obj(): self
    {
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    const ValidatorRequire = 'Require';
    const ValidatorRequireAcceptEmpty = 'RequireAcceptEmpty';
    const ValidatorOptional = 'Optional';

    const TypeEmail = 'email';
    const TypeIP = 'ip';
    const TypeMobileEgypt = 'mobile_egypt';
    const TypeName = 'name';
    const TypeNameEn = 'name_en';
    const TypeNameAr = 'name_ar';
    const TypeUsername = 'username';
    const TypeMainHash = 'main_hash';
    const TypePhone = 'phone';
    const TypePhoneFull = 'phone_full';
    const TypeYear = 'year';
    const TypeMonth = 'month';
    const TypeDay = 'day';
    const TypeYearMonth = 'year_month';
    const TypeDate = 'date';
    const TypeDateTime = 'datetime';
    const TypePassword = 'password';
    const TypeAccountNo = 'account_no';
    const TypePin = 'pin';
    const TypeCode = 'code';
    const TypeAppType = 'app_type';
    const TypeInt = 'int';
    const TypeFloat = 'float';
    const TypeBool = 'bool';
    const TypeDeviceId = 'device_id';
    const TypeString = 'string';
    const TypeComment = 'comment';
    const TypeToken = 'token';
    const TypeApiKey = 'api_key';

}