<?php

/*
 * This file is part of the 2amigos/2fa-library project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Da\TwoFA\Validator;

use Da\TwoFA\Contracts\ValidatorInterface;
use Da\TwoFA\Traits\OathTrait;

class OneTimePasswordValidator implements ValidatorInterface
{
    use OathTrait;

    /**
     * @var string
     */
    protected $seed;
    /**
     * @var int
     */
    protected $cycles;
    /**
     * @var int
     */
    protected $startTime;
    /**
     * @var int
     */
    protected $time;
    /**
     * @var int|null
     */
    protected $previousTime;

    /**
     * OneTimePasswordValidator constructor.
     *
     * @param string   $seed
     * @param int      $cycles
     * @param int      $tokenLength
     * @param int      $startTime
     * @param int      $time
     * @param int|null $previousTime
     */
    public function __construct($seed, $cycles, $tokenLength, $startTime, $time, $previousTime = null)
    {
        $this->seed = $seed;
        $this->cycles = $cycles;
        $this->tokenLength = $tokenLength;
        $this->startTime = $startTime;
        $this->time = $time;
        $this->previousTime = $previousTime;
    }

    /**
     * Validates OTP. If `$previousTime` has been added, it will return the `$startTime`, otherwise it will return a
     * bool value. This is done to prevent an attacker to use the same key again.
     *
     * @param string $value
     *
     * @param mixed $value
     *
     * @return bool|int
     */
    public function validate($value)
    {
        for (; $this->startTime <= $this->time + $this->cycles; $this->startTime++) {
            if(function_exists('hash_equals')) {
                if (hash_equals($this->oathHotp($this->seed, $this->startTime), $value)) {
                    return
                        null === $this->previousTime
                            ? true
                            : $this->startTime;
                }
            }else{
                if ($this->hash_equals($this->oathHotp($this->seed, $this->startTime), $value)) {
                    return
                        null === $this->previousTime
                            ? true
                            : $this->startTime;
                }
            }
        }

        return false;
    }
    
    private  function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
          return false;
        } else {
          $res = $str1 ^ $str2;
          $ret = 0;
          for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
          return !$ret;
        }
      }
}
