<?php

namespace App\Service;

use App\Repository\ObjectifRepositoryInterface;
//use Framework\Database\StatementInterface;

class ObjectifService
{
    /**
     * @var
     */
    private $Objectif;

    /**
     * ObjectifService constructor.
     *
     * @param ObjectifRepositoryInterface $objectifRepository
     */
    public function __construct(ObjectifRepositoryInterface $objectifRepository)
    {
        $this->Objectif = $objectifRepository;
    }

    /**
     * @return array
     */
    public function allObjectif(): array
    {
        $objectif = $this->Objectif->allObjectifs();
        return $objectif;
    }

}