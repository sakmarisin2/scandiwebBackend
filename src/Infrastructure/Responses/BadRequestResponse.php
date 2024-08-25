<?php
namespace Infrastructure\Responses;
use Domain\Interfaces\ResponseStrategy;
class BadRequestResponse implements ResponseStrategy {
    public function handle($data): void {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Bad request']);
    }
}