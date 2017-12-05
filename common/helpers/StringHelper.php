<?php

namespace common\helpers;

/**
 * StringHelper
 *
 */
class StringHelper extends \yii\helpers\BaseStringHelper
{
    /**
     * Generates a random string of specified length.
     * The string generated matches [A-Za-z0-9]+ and is transparent to URL-encoding.
     *
     * @param int $length the length of the key in characters
     * @return string the generated random key
     * @throws Exception on failure.
     */
    public static function generateRandomString($bytes, $length = 32)
    {
        if (!is_int($length)) {
            throw new InvalidParamException('First parameter ($length) must be an integer');
        }

        if ($length < 1) {
            throw new InvalidParamException('First parameter ($length) must be greater than 0');
        }
        $arr = [
            "+" => "",
            "/" => "",
            "=" => ""
        ];
        $code = strtr(base64_encode($bytes), $arr);
        return substr($code, 0, $length);
    }
}
