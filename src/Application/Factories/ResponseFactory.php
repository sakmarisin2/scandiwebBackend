<?php
namespace Application\Factories;
use Infrastructure\Responses\BadRequestResponse;
use Infrastructure\Responses\SuccessResponse;
use Infrastructure\Responses\CreatedResponse;
use Domain\Interfaces\ResponseStrategy;

class ResponseFactory {
    public static function createStrategy($condition): ResponseStrategy {
        $strategies = [
            'integer' => new CreatedResponse(),
            'array' => new SuccessResponse(),
            'string' => new SuccessResponse(),
            'NULL' =>  new BadRequestResponse(),
            
            'default' =>  new BadRequestResponse(),
        ];

        $type = gettype($condition);
        
        return $strategies[$type] ?? new BadRequestResponse(); 
    }
}