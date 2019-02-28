<?php

namespace App\Repository;

use Framework\Database\DatabaseInterface;

class PdoFormationRepository implements FormationRepositoryInterface
{
    /**
     * @var
     */
    private $database;

    /**
     * PdoFormationRepository constructor.
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
    public function allFormation(): array
    {
        return $this->database->request('SELECT * FROM formation')->fetchAll();
    }
}