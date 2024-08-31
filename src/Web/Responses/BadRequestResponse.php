<?php

namespace Web\Responses;

use Web\WebServices\ResponseStrategy;

class BadRequestResponse implements ResponseStrategy {
    public function handle($data): void {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => $data[0] ?? 'Bad request']);
    }
}