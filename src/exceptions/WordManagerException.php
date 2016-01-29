<?php
namespace John\Exceptions;

use Exception;

/**
 * Word Manager Exceptions.
 *
 * Handles errors in the CRUD Methods in John\Cp\UrbanWordsManager
 *
 */
class WordManagerException extends Exception
{

    protected $message;
    /**
     *  Capture thrown error message
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
