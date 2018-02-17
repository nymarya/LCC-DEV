<?php

namespace App\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    /**
     * Create a new authorization exception.
     *
     * @param  string  $message
     */
    public function __construct($message = 'Unauthorized.')
    {
        parent::__construct($message);
    }
}
