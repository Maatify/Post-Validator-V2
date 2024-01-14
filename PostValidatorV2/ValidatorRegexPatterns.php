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

abstract class ValidatorRegexPatterns
{
    protected function Patterns(string $typeName): string
    {
        return match ($typeName) {
            'name',
            'name_ar' => '/^[\p{Arabic}a-zA-Z_\-\s\d]*$/iu',
            'name_en' => '/^[a-zA-Z_\-\s]*$/i',
            'username' => '/^[a-zA-Z0-9]*$/i',
            'main_hash' => '/^[A-F0-9]{32}$/',
            'phone' => '/^\d*$/i',
            'phone_full' => '/^\+\d*$/i',
            'year' => '/^(19[0-9][0-9]|2[0-1][0-9][0-9])$/',
            'month' => '/^((0[1-9]|1[0-2]))$/',
            'day' => '/^(0[1-9]|[1-2][0-9]|3[0-1])$/',
            'year_month' => '/^(19[0-9][0-9]|2[0-1][0-9][0-9])-(0[1-9]|1[0-2])$/',
            'date' => '/^(19[0-9][0-9]|2[0-1][0-9][0-9])-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',
            'datetime' => '/^(19[0-9][0-9]|2[0-1][0-9][0-9])-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[0-9]|1[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/',
            'password' => '/^(?=.*\d)(?=.*[a-zA-Z])[0-9A-Za-z!@#$%+_\-&]{7,70}$/',
            'account_no' => '/^[0-9]{9}$/',
            'egypt_national_id' => '/^[0-9]{14}$/',
            'pin', 'code' => '/^[0-9]{6}$/',
            'app_type' => '/^[1-3]{1}$/',
            'int', 'status_id' => '/^[0-9]+$/i',
            'float' => '/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',
            'bool', 'status' => '/^[0-1]{1}$/',
            'device_id' => '/^[a-zA-Z_\-\d]*$/i',
            'key' => '/^[a-zA-Z0-9_]*$/i',
            'parameter_type' => '/^[a-z]{3,6}$/',
            'token'=>'/^[a-zA-Z0-9._\-]+$/',
            'api_key'=>'/^[A-Za-z0-9]+$/',
            'slug' => '/^[a-z0-9\-]+$/',
            'letters' => '/^[a-zA-Z]*$/i',
            'small_letters' => '/^[a-z]*$/i',
            'upper_letters' => '/^[A-Z]*$/i',
            'digital_small_letters' => '/^[a-z\d]*$/i',
            'digital_upper_letters' => '/^[A-Z\d]*$/i',
            'json' => '((\[[^\}]+)?\{s*[^\}\{]{3,}?:.*\}([^\{]+\])?)',
            'search' => '/^[a-zA-Z_\-\s\d]*$/i',
            'col_name' => '/^[a-z_\d]*$/i',
            'stripe_id' => '/^[a-zA-Z\-_\d]*$/i',

            default => '',
        };
    }
}