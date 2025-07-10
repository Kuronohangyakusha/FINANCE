<?php
namespace App\Core\abstract;


use Database\Database;
use PDO;

abstract class AbstractRepository {
    protected PDO $pdo;
    
    public function __construct() {
        $this->pdo = Database::getConnection();
    }
    
    abstract public function findById(int $id);
    abstract public function create($entity): bool;
    abstract public function update($entity): bool;
    abstract public function delete(int $id): bool;
    abstract public function findAll(): array;
}