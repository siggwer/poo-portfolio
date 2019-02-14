<?php

namespace App\Repository;

use Framework\Database\DatabaseInterface;
//use Framework\Database\StatementInterface;

class PdoObjectifRepository implements ObjectifRepositoryInterface
{
    /**
     * @var
     */
    private $database;

    /**
     * PdoObjectifRepository constructor.
     *
     * @param DatabaseInterface $database
     */
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @return array
     */
    public function allObjectifs(): array
    {
        return $this->database->request('SELECT * FROM objectif LIMIT 1')->fetchAll();
    }
}