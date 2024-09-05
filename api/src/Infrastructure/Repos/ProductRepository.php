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

            $stmt = $this->conn->prepare("INSERT INTO " . self::TABLE ."(name,type_id,SKU,price) VALUES (?,?,?,?)");
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
                $productId = (int) $row['product_id'];
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'id' => $productId,
                        'SKU' => $row['SKU'],
                        'name' => $row['product_name'],
                        'price' => (float) $row['price'],
                        'type' => $row['product_type'],
                        'attributes' => []
                    ];
                }
    
                if (!empty($row['attribute_name']) && !empty($row['attribute_value'])) {
                    $products[$productId]['attributes'][$row['attribute_name']] = $row['attribute_value'];
                }
            }
    
            $productDtos = [];
            foreach ($products as $productData) {
                $productDtos[$productData['id']] = new ProductDto(
                    $productData['id'],
                    $productData['SKU'],
                    $productData['name'],
                    $productData['price'],
                    $productData['type'],
                    $productData['attributes']
                );
            }
    
            return $productDtos;

        }catch(Exception $e){

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
    public function delete(array $productIds): string{
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
    public function productExistsBySku($sku) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM " . self::TABLE . " WHERE SKU = :sku");

        $stmt->bindParam(':sku', $sku);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}