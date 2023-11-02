<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2023-11-08
 * Time: 11:31 AM
 * https://www.Maatify.dev
 */

namespace Maatify\PostValidator;

class ValidatorConstantsValidators
{
    private static self $instance;

    public static function obj(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    const Require = 'Require';
    const AcceptEmpty = 'RequireAcceptEmpty';
    const Optional = 'Optional';
}