<?php

namespace Application\Factories;

use Domain\Interfaces\FactoryInterface;
use Web\Responses\BadRequestResponse;
use Web\Responses\SuccessResponse;
use Web\Responses\CreatedResponse;
use Web\WebServices\Interfaces\ResponseStrategy;

class ResponseFactory implements FactoryInterface{
    public static function create($condition): ResponseStrategy {
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