<?php

namespace Application\Factories;

use Domain\Core\BaseProduct;
use Domain\Entities\Book;
use Domain\Entities\DVD;
use Domain\Entities\Furniture;
use Domain\Interfaces\FactoryInterface;

class ProductFactory implements FactoryInterface{
    private static $paramSet = ['SKU', 'Name', 'Price', 'Type'];
    private static $classMap = [
        1 => [
            'class' => DVD::class,
            'params' => ['size'],
        ],
        2 => [
            'class' => Furniture::class,
            'params' => ['height', 'width', 'length']
        ],
        3 => [
            'class' => Book::class,
            'params' => ['weight']
        ],
    ];

    public static function create($data): BaseProduct
    {
        $typeId = $data->getType();
        
        if (!isset(self::$classMap[$typeId])) {
            throw new \InvalidArgumentException("Unsupported typeId: $typeId");
        }
        
        $classInfo = self::$classMap[$typeId];
        $className = $classInfo['class'];
        $params = $classInfo['params'];

        $constructorArgs = [];
        
        foreach (self::$paramSet as $param) {
            $getter = 'get' . ucfirst($param);
            $constructorArgs[] = $data->$getter();
        }

        $attributes = $data->getAttributes();

        foreach ($params as $param) {
            $constructorArgs[] = $attributes[$param];
        }

        return new $className(...$constructorArgs);
    }
}