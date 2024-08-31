<?php

namespace Application\Factories;

use Domain\Core\BaseProduct;
use Domain\Entities\Book;
use Domain\Entities\DVD;
use Domain\Entities\Furniture;

class ProductFactory{
    private static $paramSet = ['SKU', 'name', 'price', 'type'];
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

    public static function create(array $data):BaseProduct{
        $classInfo = self::$classMap[$data['type']];
        $className = $classInfo['class'];
        $params = $classInfo['params'];

        $dataAttributes = $data['attributes'];
        unset($data['attributes']);

        $constructorArgs = [];
        foreach (self::$paramSet as $param) {
            if (isset($data[$param])) {
                $constructorArgs[] = $data[$param];
            }
        }
        foreach ($params as $param) {
            if (isset($dataAttributes[$param])) {
                $constructorArgs[] = $dataAttributes[$param];
            }
        }

        return new $className(...$constructorArgs);
    }
}