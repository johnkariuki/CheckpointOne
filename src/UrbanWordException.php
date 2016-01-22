<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 20/01/2016
 * Time: 13:07
 */

namespace John\Cp;

/**
 * Class UrbanWordException
 * @package John\Cp\Errors
 */
class UrbanWordException extends \Exception
{
    protected $message;

    /**
     * UrbanWordException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        $this->message = $message;

        return $this->message;
    }
}