<?php

namespace Domain\Core;

use Domain\Core\BaseProduct;
abstract class BaseRepository{
    abstract function insert(BaseProduct $product): string;
    abstract function selectAll():array;
    abstract function delete(array $productIds):string;

}