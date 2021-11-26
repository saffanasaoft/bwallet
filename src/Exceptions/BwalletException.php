<?php

namespace Digitcode\Bwallet\Exceptions;

use Exception;

class BwalletException extends Exception
{
    public static function requestFailed(string $rc, string $message, int $code)
    {
        $error = [
            'summary' => "Terjadi error: `{$message}` dan kode error: `{$rc}`",
            'message' => $message,
            'response_code' => $rc
        ];

        return new static(json_encode($error), $code);
    }

    public function render($request)
    {
        return response(['error' => $this->getMessage()], $this->getCode());
    }
}
