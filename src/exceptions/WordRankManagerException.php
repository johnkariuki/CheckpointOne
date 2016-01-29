<?php

namespace John\Exceptions;

use Exception;

/**
 * WorkRank Manager Exceptions.
 *
 */
class WordRankManagerException extends Exception
{

    protected $message;
    /**
     *  Capture thrown [errorMessage]
     *
     * @return [string] [Return caught error]
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Return thrown error message
     *
     * @return string error message
     */
    public function errorMessage()
    {
         return $this->message;
    }
}
