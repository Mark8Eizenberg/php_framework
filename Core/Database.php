<?php

namespace Core;

use PDO;
use Core\Router;

class Database
{
    private $pdo;
    private $statement;
    
    public function __construct($config, $username, $password)
    {
        $dsn = 'mysql:'.http_build_query($config, '', ';');
        $this->pdo = new PDO($dsn, $username, $password);
    }
    
    public function query($query, $params = [])
    {
                
        $this->statement = $this->pdo->prepare($query);
        $this->statement->execute($params);
        
        return $this;
        
    }

    public function find($param = PDO::FETCH_ASSOC)
    {
        return $this->statement->fetch($param);
    }

    public function findAll($param = PDO::FETCH_ASSOC)
    {
        return $this->statement->fetchAll($param);
    }

    public function findOrFaild($param = PDO::FETCH_ASSOC)
    {
        $result = $this->find($param);

        if(!$result){
            Router::abort();
        }

        return $result;
    }

    public function findAllOrFaild($param = PDO::FETCH_ASSOC)
    {
        $result = $this->findAll($param);

        if(!$result){
            Router::abort();
        }

        return $result;
    }
}