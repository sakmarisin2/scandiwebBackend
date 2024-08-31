<?php

namespace Infrastructure\Repos;

use Domain\Core\BaseRepository;
use Domain\Core\BaseProduct;
use Infrastructure\DTO\ProductDto;
use Exception;
use PDO;

class ProductRepository extends BaseRepository{
    private const TABLE = "products";
    private const ATTR_TABLE = "product_attributes";
    private PDO $conn;
    public function __construct(PDO $pdo){
        $this->conn = $pdo;
    }
    public function insert(BaseProduct $product): string{
        try{
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO " . self::TABLE ."(name, type_id,SKU,price) VALUES (?, ?,?, ?)");
            $stmt->execute([$product-> getName(), 
                            $product-> getType(),
                            $product-> getSKU(),
                            $product-> getPrice()]);
            $result = $this->conn->lastInsertId();

            foreach ($product->getAttributes() as $attribute_name => $attribute_value) {
                $stmt = $this->conn->prepare("INSERT INTO ". self::ATTR_TABLE . " (product_id, attribute_name, attribute_value) VALUES (?, ?, ?)");
                $stmt->execute([$result, $attribute_name, $attribute_value]);
            }

            $this->conn->commit();

            return $result;

        }catch(Exception $e){

            $this->conn->rollBack();
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
    public function selectAll():array{
        try{
            $sql = "SELECT p.id AS product_id, p.SKU, p.price, p.name AS product_name, pt.type_name AS product_type, pa.attribute_name, pa.attribute_value
                    FROM " . self::TABLE . " p
                    JOIN product_types pt ON p.type_id = pt.id
                    LEFT JOIN " . self::ATTR_TABLE . " pa ON p.id = pa.product_id
                    ORDER BY p.name;";

            $stmt = $this-> conn -> prepare($sql);
            $stmt -> execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $products = [];

            foreach ($results as $row) {
                if (!isset($products[$row['product_id']])) {
                    $products[$row['product_id']] = new ProductDto(
                        $row['product_id'],
                        $row['SKU'],
                        $row['product_name'],
                        $row['price'],
                        $row['product_type'],
                        $row['attributes'],
                    );
                }
            }

            return $products;

        }catch(Exception $e){

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
    public function delete($productIds = []): string{
        try{
            $this->conn->beginTransaction();

            $placeholders = implode(',', array_fill(0, count($productIds), '?'));
            $sql = "DELETE FROM ". self::TABLE ." WHERE id IN ($placeholders)";
    
            $stmt = $this->conn ->prepare($sql);
            $stmt->execute($productIds);

            $this->conn->commit();
    
            return "Deleted " . $stmt->rowCount() . " products successfully.";
        }catch(Exception $e){

            $this->conn->rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}