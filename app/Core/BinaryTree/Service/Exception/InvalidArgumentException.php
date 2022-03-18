<?php

namespace App\Core\BinaryTree\Service\Exception;

class InvalidArgumentException extends \Exception
{
    const DEFAULT_MESSAGE = 'Invalid Argument %s';
    const DEFAULT_CODE    = 1;

    /**
     * @throws InvalidArgumentException
     */
    public static function throw (
        string $argument,
        ?string $message = null,
        ?int $code = null
    ) {
        $message = $message ?? sprintf(self::DEFAULT_MESSAGE, $argument);
        $code = $code ?? self::DEFAULT_CODE;
        throw new self($message, $code);
    }
}
