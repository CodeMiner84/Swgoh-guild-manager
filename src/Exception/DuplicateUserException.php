<?php

namespace App\Exception;

/**
 * Class DuplicateUserException.
 */
class DuplicateUserException extends \Exception
{
    private const MESSAGE = 'Username already exists';

    /**
     * DuplicateUserException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($message = self::MESSAGE, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
