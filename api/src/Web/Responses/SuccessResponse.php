<?php

namespace Web\Responses;

use Web\WebServices\Interfaces\ResponseStrategy;

class SuccessResponse implements ResponseStrategy {
    public function handle($data): void {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'data' => $data]);
    }
}