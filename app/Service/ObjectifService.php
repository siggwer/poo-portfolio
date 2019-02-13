<?php

namespace App\Service;

use App\Repository\ObjectifRepositoryInterface;
//use Framework\Database\StatementInterface;

class ObjectifService
{
    /**
     * @var
     */
    private $ObjectifRepository;

    /**
     * ObjectifService constructor.
     *
     * @param ObjectifRepositoryInterface $objectifRepository
     */
    public function __construct(ObjectifRepositoryInterface $objectifRepository)
    {
        $this->ObjectifRepository = $objectifRepository;
    }

    /**
     * @return array
     */
    public function allObjectif(): array
    {
        $objectif = $this->allObjectif();
        return $objectif;
    }

}