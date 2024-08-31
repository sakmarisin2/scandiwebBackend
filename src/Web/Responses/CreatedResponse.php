<?php

namespace Web\Responses;

use Web\WebServices\ResponseStrategy;

class CreatedResponse implements ResponseStrategy {
    public function handle($data): void {
        http_response_code(201);
        echo json_encode(['status' => 'Success', 'message' => "Created product id: {$data}"]);
    }
}