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

use \App\Assist\AppFunctions;
use \App\Assist\RegexPatterns;
use Maatify\Json\Json;

class GetValidator extends ValidatorRegexPatterns
{
    private static self $instance;

    public static function obj(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected static int|string $line;
    private RegexPatterns $regex_patterns;


    public function ValidateGet(string $name, string $type = 'string', string $more_info = ''): bool|int
    {
        return $this->HandleGetType($name, $type, $more_info);
    }

    public function Optional(string $name, string $type = 'string', string $more_info = ''): string
    {
        if(!empty($_GET) && !empty($_GET[$name]) && !is_array($_GET[$name])){
            return $this->HandleGetType($name, $type, $more_info);
        }else{
            if(in_array($type, ['page', 'limit'])){
                if (empty($_GET[$name]) || !is_numeric($_GET[$name])) {
                    return match ($type) {
                        'page' => 1,
                        'limit' => AppFunctions::pagination_limit,
                    };
                }
            }
        }
        return '';
    }

    private function HandleGetType(string $name, string $type, string $more_info): string
    {
        if (empty($regex = $this->regex_patterns::Patterns($type))) {
            $regex = $this->Patterns($type);
        }
        if(!empty($regex)){
            if(!preg_match($regex, $_GET[$name])){
                Json::Invalid($name, $more_info, self::$line);
                exit();
            }
        }
        return self::ClearInput($_GET[$name]);
    }

    private function ClearInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data,ENT_QUOTES|ENT_SUBSTITUTE);
    }
}