<?php

namespace App\Library;

use App\Models\Users;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;
use App\Controllers\HttpExceptions\Http400Exception;
use App\Services\AbstractService;

/**
 * manages data validation.
 * Class RequestValidationService
 * @package App\Library
 */
class RequestValidationService
{

    public static function validateRequestHeaders($headers, $rules)
    {
        foreach ($rules as $name => $type) {
            if (! isset($headers[$name]) || empty($headers[$name]) || ! self::validateHeaderType($headers[$name], $type)) {
                throw new Http400Exception('Invalid Header Paramaters', AbstractService::ERROR_INVALID_PARAMETERS);
            }
        }
        // if all headers passed validation then we return true
        return true;
    }

    public static function validateRequestBody($data, $rules)
    {
        if ($data === null) {
            throw new Http400Exception('Invalid Request Data', AbstractService::ERROR_INVALID_PARAMETERS);
        }
        $validation = new Validation();
        foreach ($rules as $fieldName => $fieldRulesAsString) {
            $fieldRules = explode('|', $fieldRulesAsString);

            foreach ($fieldRules as $rule) {
                if($rule === 'required') {
                    $validation->add(
                        $fieldName,
                        new PresenceOf(
                            [
                                'message' => 'The field '. $fieldName .' is required',
                            ]
                        )
                    );
                }

                elseif($rule === 'numeric') {
                    $validation->add(
                        $fieldName,
                        new Numericality(
                            [
                                'message' => 'The field '. $fieldName .' must be a valid number',
                            ]
                        )
                    );
                }

                elseif($rule === 'email') {
                    $validation->add(
                        $fieldName,
                        new Email(
                            [
                                'message' => 'The field '. $fieldName .' must be a valid email',
                            ]
                        )
                    );
                } elseif(substr( $rule , 0, 6 ) === 'length') {
                    $min = self::getStringBetween($rule, '(', ',');
                    $max = self::getStringBetween($rule, ',', ')');
                    if(! is_numeric($min) || ! is_numeric($max)) {
                        throw new Http400Exception('Invalid Request Data', AbstractService::ERROR_INVALID_PARAMETERS);
                    }

                    $validation->add(
                        $fieldName,
                        new StringLength(
                            [
                                "max"            => $max,
                                "min"            => $min,
                                "messageMaximum" => 'the field '. $fieldName .' minimum length is' . $min,
                                "messageMinimum" => 'the field '. $fieldName .' maximum length is' . $max,
                            ]
                        )
                    );
                } elseif (substr( $rule , 0, 6 ) === 'unique') {
                    $table = substr($rule, strpos($rule, ":") + 1);
                    if(! is_string($table)) {
                        throw new Http400Exception('Invalid Request Data', AbstractService::ERROR_INVALID_PARAMETERS);
                    }

                    $model = 'App\Models\\' . ucwords($table);

                    $validation->add(
                        $fieldName,
                        new Uniqueness(
                            [
                                "model"   => new $model(),
                                "message" => $fieldName . ' must be unique',
                            ]
                        )
                    );

                }
            }
        }

        $validationMessages = $validation->validate($data);

        if(count($validationMessages)) {
            throw new Http400Exception('Invalid Request Data', AbstractService::ERROR_INVALID_PARAMETERS);
        } else {
            return true;
        }
    }

    private static function validateHeaderType($headerValue, $type)
    {
        if ($type === 'string') {
            if( ! is_string($headerValue)) {
                throw new Http400Exception('Invalid Header Paramaters', AbstractService::ERROR_INVALID_PARAMETERS);
            }

            return true;
        } elseif ($type === 'integer') {
            if( ! is_integer($headerValue)) {
                throw new Http400Exception('Invalid Header Paramaters', AbstractService::ERROR_INVALID_PARAMETERS);
            }

            return true;
        }
    }

    private static function getStringBetween($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);

    }
}