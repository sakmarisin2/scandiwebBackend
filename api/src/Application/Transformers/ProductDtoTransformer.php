<?php

namespace Application\Transformers;

use Infrastructure\DTO\ProductDto;

class ProductDtoTransformer
{
    public static function transform(ProductDto $productDto): array
    {
        return $productDto -> toArray();
    }

    public static function transformCollection(array $productDtos): array
    {
        return array_map([self::class, 'transform'], $productDtos);
    }
}
