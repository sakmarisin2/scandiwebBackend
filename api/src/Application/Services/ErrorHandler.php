<?php

namespace Application\Services;

use Throwable;

class ErrorHandler{
    public static function handleException(Throwable $ex): void{
        http_response_code(500);
        echo json_encode([
            "code" => $ex -> getCode(),
            "message" => $ex -> getMessage()
        ]);
    }
}