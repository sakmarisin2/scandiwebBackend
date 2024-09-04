<?php

namespace Infrastructure\Database;

use PDO;
use PDOException;

class Database{
    public function __construct(private string $host,
                                private string $name,
                                private string $user,
                                private string $password,
                                private string $port,
                                private string $sslCa)
    {}

    public function getConnection(): ?PDO
    {
        try{
            $dns = "mysql:host={$this->host};port={$this->port};dbname={$this->name};charset=utf8"
                . ";ssl_ca={$this->sslCa}";
            $pdoOptions = [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false,
            ];
            $result = new PDO($dns, $this->user, $this->password, $pdoOptions);

            return $result;

        } catch(PDOException $e){
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return null;
        }
    }
}